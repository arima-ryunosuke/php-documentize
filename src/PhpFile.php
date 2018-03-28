<?php

namespace ryunosuke\Documentize;

/**
 * 雑に php パースするクラス
 */
class PhpFile
{
    /** @var array gather 結果のキャッシュ */
    private static $cache = [];

    /** @var array 処理するトークン */
    private $tokens;

    /** @var int トークン数 */
    private $length;

    /** @var int 現在位置 */
    private $position;

    /**
     * 与えられたコードを実行する
     *
     * eval のエラーが分かりにくいので見やすくするのが主目的でそれ以上の意味は持ってないし持たせない。
     * 現スコープのローカル変数が使えなかったりするので普通に eval した方がいい場面もある（一応引数で渡せるが）。
     *
     * @param string $phpcode 実行する php コード
     * @param array $scope 元スコープの変数を渡す想定の配列
     * @return mixed eval の実行結果
     */
    public static function evaluate($phpcode, $scope = [])
    {
        try {
            extract($scope);
            return eval($phpcode);
        }
        catch (\ParseError $pe) {
            throw new \RuntimeException("eval failed. " . $phpcode, 0, $pe);
        }
    }

    public static function cache($filename)
    {
        if ($filename === null) {
            return self::$cache;
        }

        $filename = realpath($filename);
        if (!isset(self::$cache[$filename])) {
            self::$cache[$filename] = (new self($filename))->gather();
        }
        return self::$cache[$filename];
    }

    public function __construct($filename_or_code)
    {
        // 直接入れてもいいが token_get_all の結果は微妙に扱いづらいので少し調整する（string/array だったり、名前変換の必要があったり）
        /** @noinspection PhpUndefinedConstantInspection */
        $this->tokens = array_map(function ($token) {
            if (is_array($token)) {
                // for debug
                //$token[] = token_name($token[0]);
                return $token;
            }
            else {
                // string -> [TOKEN, CHAR, LINE]
                return [null, $token, 0];
            }
        }, token_get_all(file_exists($filename_or_code) ? file_get_contents($filename_or_code) : $filename_or_code, TOKEN_PARSE));
        $this->length = count($this->tokens);
        $this->position = 0;
    }

    /**
     * 現在位置を戻す
     *
     * @return $this 自分自身
     */
    public function reset()
    {
        $this->position = 0;
        return $this;
    }

    /**
     * 現在位置のトークンを返す
     *
     * @return array|false 現在位置のトークン。終端まで達しているなら false
     */
    public function current()
    {
        if ($this->position >= $this->length) {
            return false;
        }

        return $this->tokens[$this->position];
    }

    /**
     * T_WHITESPACE 以外の前のトークンを返す
     *
     * @return array|false 前のトークン。初期値なら false
     */
    public function prev()
    {
        if ($this->position === 0) {
            return false;
        }

        for ($i = $this->position - 1; $i >= 0; $i--) {
            if ($this->tokens[$i][0] === T_WHITESPACE) {
                continue;
            }
            break;
        }
        $this->position = $i;
        return $this->current();
    }

    /**
     * T_WHITESPACE 以外の次のトークンを返す
     *
     * @return array|false 次のトークン。終端まで達しているなら false
     */
    public function next()
    {
        if ($this->position >= $this->length) {
            return false;
        }

        for ($i = $this->position + 1; $i < $this->length; $i++) {
            if ($this->tokens[$i][0] === T_WHITESPACE) {
                continue;
            }
            break;
        }
        $this->position = $i;
        return $this->current();
    }

    /**
     * 指定されたトークン種別が出現するまで読み飛ばす（T_WHITESPACE 除外）
     *
     * @param int|string|array $next_token ストップトークン。int なら T_*** 定数、 string なら文字種。配列なら要素で OR 動作
     * @return array|false 読み飛ばすまでに読み込んだトークン。終端まで達しているなら false
     */
    public function skip($next_token)
    {
        if ($this->position >= $this->length) {
            return false;
        }

        if (!is_array($next_token)) {
            $next_token = [$next_token];
        }

        $result = [];
        for ($i = $this->position + 1; $i < $this->length; $i++) {
            if ($this->tokens[$i][0] === T_WHITESPACE) {
                continue;
            }

            foreach ($next_token as $nt) {
                if ($nt === $this->tokens[$i][0] || $nt === $this->tokens[$i][1]) {
                    break 2;
                }
            }

            $result[] = $this->tokens[$i];
        }
        $this->position = $i;
        return $result;
    }

    /**
     * 本ツールにおいて必要な情報をかき集める
     *
     * 非常に雑にやっているので
     * - 名前空間の下の方で use している
     * - {} を使ったまとめて use
     * などの use 節は検出できない（が実用上は十分のはず）。
     *
     * また、メンバーにおいてメソッドの行番号は設定しない。
     * ブロックの終わりの検出が面倒な上、そもそもメソッドだけはリフレクションで正確に取れるので取得自体不要。
     * ただし、「そのクラス自身で定義されているか？」はリフレクションで取れないので、キーだけは設定される。
     *
     * @return array ファイル単位の名前空間マッピングやクラスメンバー配列
     */
    public function gather()
    {
        $this->reset();

        $use = static function ($ns, $parts, &$result) {
            $alias = null;
            $uses = [];
            foreach ($parts as $i => $part) {
                if ($part[0] === T_AS) {
                    $alias = $parts[$i + 1][1];
                    break;
                }
                $uses[] = $part[1];
            }
            if ($alias === null) {
                $alias = end($uses);
            }
            $result[$alias] = $ns . ltrim(implode('', $uses), '\\');
        };

        $result = [];
        $namespace = '';
        $classname = '';

        while (true) {
            $this->skip([T_NAMESPACE, T_CLASS, T_TRAIT, T_INTERFACE, T_USE, T_CONST, T_PRIVATE, T_PROTECTED, T_PUBLIC, T_VAR, T_FUNCTION]);
            $current = $this->current();
            if ($current[0] === T_NAMESPACE) {
                $classname = '';
                $namespace = implode('', array_column($this->skip([';', '{']), 1));
            }
            elseif ($current[0] === T_CLASS || $current[0] === T_TRAIT || $current[0] === T_INTERFACE) {
                $next = $this->next();
                $classname = ltrim($namespace . '\\' . $next[1], '\\');
                $result[$namespace]['@using'][$next[1]] = $classname;
            }
            elseif ($current[0] === T_USE) {
                $parts = $this->skip([';', '{']);
                $current = $this->current();

                // おそらくクラス定義の use trait
                if ($classname) {
                    continue;
                }
                // おそらく use const/function
                if ($parts[0][0] === T_CONST || $parts[0][0] === T_FUNCTION) {
                    continue;
                }

                // 単一指定モード
                if ($current[1] === ';') {
                    $use('', $parts, $result[$namespace]['@using']);
                }
                // 複数指定モード
                elseif ($current[1] === '{') {
                    $ns = ltrim(implode('', array_column($parts, 1)), '\\');
                    do {
                        $use($ns, $this->skip(['}', ',']), $result[$namespace]['@using']);
                    } while ($this->current()[1] === ',');
                }
            }
            elseif ($current[0] === T_CONST || $current[0] === T_PRIVATE || $current[0] === T_PROTECTED || $current[0] === T_PUBLIC || $current[0] === T_VAR) {
                $token = $this->current();
                $mode = $token[0];
                $start = $token[2];
                $name = '';
                $end = 0;
                $parts = $this->skip([';', '{']);
                foreach ($parts as $n => $part) {
                    if ($part[0] === T_FUNCTION) {
                        // T_FUNCTION からメソッド名までに邪魔者はいない…と思ったんだが参照返しの & がいる可能性があるので T_STRING まで読み飛ばし
                        $next = $part;
                        for ($i = $n + 1, $l = count($parts); $i < $l; $i++) {
                            if ($parts[$i][0] === T_STRING) {
                                $next = $parts[$n + 1];
                                break;
                            }
                        }
                        $result[$namespace][$classname][$next[1] . '()'] = [null, null];// リフレクションで取ったほうが正確なので設定しない
                        continue 2;
                    }
                    elseif (!$name && $part[0] === T_STRING) {
                        $name = $part[1];
                    }
                    elseif (!$name && $mode !== T_CONST && $part[0] === T_VARIABLE) {
                        $name = $part[1];
                    }
                    if ($part[2] !== 0) {
                        $end = $part[2];
                    }
                }
                if ($name && $end) {
                    // 締めの ; の行数は得られないので、「startと同一行ならそのまま、異なるなら複数行だろう」という判断で+1する
                    if ($start < $end) {
                        $end++;
                    }
                    $result[$namespace][$classname][$name] = [$start, $end];
                }
            }
            // ↑は public などのアクセス修飾子で引っ掛けている（プロパティ宣言が T_VARIABLE なのでそうしないと大量に引っかかってしまう）
            // その都合上、 T_FUNCTION も引っかかってしまうので↑で処理しているが、メソッドは修飾省略可なので別途検出しなければならない
            elseif ($current[0] === T_FUNCTION) {
                // 注意点は↑と同じ。ただしここは読み飛ばしてもいいコンテキストなので skip が使える
                $this->skip([T_STRING, '{', ';']);
                if ($this->current()[0] === T_STRING) {
                    $result[$namespace][$classname][$this->current()[1] . '()'] = [null, null];// リフレクションで取ったほうが正確なので設定しない
                }
            }
            else {
                break;
            }
        }
        return $result;
    }
}
