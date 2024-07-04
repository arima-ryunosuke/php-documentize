<?php

namespace ryunosuke\Documentize;

/**
 * 雑に php パースするクラス
 */
class PhpFile
{
    /** @var array gather 結果のキャッシュ */
    private static $cache = [];

    /** @var \PhpToken[] 処理するトークン */
    private $tokens;

    /** @var int トークン数 */
    private $length;

    /** @var int 現在位置 */
    private $position;

    public static function cache($filename, $content = null)
    {
        if ("$filename" === "") {
            return self::$cache;
        }

        $filename = realpath($filename);
        // $content が指定されているなら強制的に設定する（別途キャッシュで読み込まれてこのメソッドを経由しないことがあるため）
        if (!isset(self::$cache[$filename]) || $content) {
            self::$cache[$filename] = $content ?: (new self($filename))->gather();
        }
        return self::$cache[$filename];
    }

    public function __construct($filename_or_code)
    {
        $this->tokens = php_parse(file_exists($filename_or_code) ? file_get_contents($filename_or_code) : $filename_or_code, [
            'flags' => TOKEN_PARSE,
            'cache' => false,
        ]);
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
     * @return \PhpToken|false 現在位置のトークン。終端まで達しているなら false
     */
    public function current()
    {
        if ($this->position >= $this->length) {
            return false;
        }

        return $this->tokens[$this->position];
    }

    /**
     * 指定されたトークン種別が出現するまで読み戻る（T_WHITESPACE 除外）
     *
     * @param int|string|array $stop_token ストップトークン。int なら T_*** 定数、 string なら文字種、配列なら要素で OR 動作、null （省略）なら直前のトークン
     * @return array|false 読み戻る間に読み込んだトークン。開始まで達したなら false。ストップトークンが null だったら単一要素
     */
    public function prev($stop_token = null)
    {
        if ($this->position === 0) {
            return false;
        }

        if ($stop_token !== null && !is_array($stop_token)) {
            $stop_token = [$stop_token];
        }

        $result = [];
        for ($i = $this->position - 1; $i >= 0; $i--) {
            if ($this->tokens[$i]->is(T_WHITESPACE)) {
                continue;
            }

            if ($stop_token === null) {
                $this->position = $i;
                return $this->current();
            }

            $result[] = $this->tokens[$i];

            foreach ($stop_token as $nt) {
                if ($this->tokens[$i]->is($nt)) {
                    break 2;
                }
            }
        }
        $this->position = $i;
        return array_reverse($result);
    }

    /**
     * 指定されたトークン種別が出現するまで読み進む（T_WHITESPACE 除外）
     *
     * @param int|string|array $stop_token ストップトークン。int なら T_*** 定数、 string なら文字種、配列なら要素で OR 動作、null （省略）なら直後のトークン
     * @return array|false 読み進む間に読み込んだトークン。終端まで達したなら false。ストップトークンが null だったら単一要素
     */
    public function next($stop_token = null)
    {
        if ($this->position >= $this->length) {
            return false;
        }

        if ($stop_token !== null && !is_array($stop_token)) {
            $stop_token = [$stop_token];
        }

        $result = [];
        for ($i = $this->position + 1; $i < $this->length; $i++) {
            if ($this->tokens[$i]->is(T_WHITESPACE)) {
                continue;
            }

            if ($stop_token === null) {
                $this->position = $i;
                return $this->current();
            }

            foreach ($stop_token as $nt) {
                if ($this->tokens[$i]->is($nt)) {
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
                if ($part->is(T_AS)) {
                    $alias = $parts[$i + 1]->text;
                    break;
                }
                $uses[] = $part->text;
            }
            if ($alias === null) {
                $alias = last_value(explode('\\', implode('', $uses)));
            }
            $result[$alias] = $ns . ltrim(implode('', $uses), '\\');
        };

        $result = [];
        $namespace = '';
        $classname = '';

        while (true) {
            $this->next([T_NAMESPACE, T_CLASS, T_TRAIT, T_INTERFACE, T_USE, T_CONST, T_PRIVATE, T_PROTECTED, T_PUBLIC, T_VAR, T_FUNCTION]);
            $current = $this->current();
            if (!$current) {
                break;
            }

            if ($current->is(T_NAMESPACE)) {
                $classname = '';
                $namespace = implode('', array_column($this->next([';', '{']), 'text'));
                $p = $this->position;
                $doccomment = $this->prev([T_DOC_COMMENT, '}']);
                $result[$namespace]['@comment'] = $doccomment[0]->is(T_DOC_COMMENT) ? $doccomment[0]->text : '';
                $this->position = $p;
            }
            elseif ($current->is([T_CLASS, T_TRAIT, T_INTERFACE])) {
                $next = $this->next();
                $classname = ltrim($namespace . '\\' . $next->text, '\\');
                $result[$namespace]['@using'][$next->text] = $classname;
            }
            elseif ($current->is(T_USE)) {
                $parts = $this->next([';', '{']);
                $current = $this->current();

                // おそらくクラス定義の use trait
                if ($classname) {
                    continue;
                }
                // おそらく use const/function
                if ($parts[0]->is(T_CONST) || $parts[0]->is(T_FUNCTION)) {
                    continue;
                }

                // 単一指定モード
                if ($current->is(';')) {
                    $use('', $parts, $result[$namespace]['@using']);
                }
                // 複数指定モード
                elseif ($current->is('{')) {
                    $ns = ltrim(implode('', array_column($parts, 'text')), '\\');
                    do {
                        $use($ns, $this->next(['}', ',']), $result[$namespace]['@using']);
                    } while ($this->current()->is(','));
                }
            }
            elseif ($current->is([T_CONST, T_PRIVATE, T_PROTECTED, T_PUBLIC, T_VAR])) {
                $mode = $current->id;
                $start = $current->line;
                $name = '';
                $end = 0;
                $parts = $this->next([';', '{']);
                foreach ($parts as $n => $part) {
                    if ($part->is(T_FUNCTION)) {
                        // T_FUNCTION からメソッド名までに邪魔者はいない…と思ったんだが参照返しの & がいる可能性があるので T_STRING まで読み飛ばし
                        $next = $part;
                        for ($i = $n + 1, $l = count($parts); $i < $l; $i++) {
                            if ($parts[$i]->is(T_STRING)) {
                                $next = $parts[$n + 1];
                                break;
                            }
                        }
                        $result[$namespace][$classname][$next->text . '()'] = [null, null];// リフレクションで取ったほうが正確なので設定しない
                        continue 2;
                    }
                    elseif (!$name && $part->is(T_STRING)) {
                        $name = $part->text;
                    }
                    elseif (!$name && $mode !== T_CONST && $part->is(T_VARIABLE)) {
                        $name = $part->text;
                    }
                    if ($part->line !== 0) {
                        $end = $part->line;
                    }
                }
                if ($name && $end) {
                    $result[$namespace][$classname][$name] = [$start, $end];
                }
                // 名前空間定数の doccomment はリフレクションで取れないのでパースして取る
                if ($mode === T_CONST && !$classname && $name) {
                    $p = $this->position;
                    $doccomment = $this->prev([T_DOC_COMMENT, ';', '{']);
                    $this->position = $p;
                    $result[$namespace]['@const'][$name] = $doccomment[0]->is(T_DOC_COMMENT) ? $doccomment[0]->text : '';
                }
            }
            // ↑は public などのアクセス修飾子で引っ掛けている（プロパティ宣言が T_VARIABLE なのでそうしないと大量に引っかかってしまう）
            // その都合上、 T_FUNCTION も引っかかってしまうので↑で処理しているが、メソッドは修飾省略可なので別途検出しなければならない
            elseif ($current->is(T_FUNCTION)) {
                // 注意点は↑と同じ。ただしここは読み飛ばしてもいいコンテキストなので skip が使える
                $this->next([T_STRING, '{', ';']);
                if ($this->current()->is(T_STRING)) {
                    $result[$namespace][$classname][$this->current()->text . '()'] = [null, null];// リフレクションで取ったほうが正確なので設定しない
                }
            }
            else {
                throw new \DomainException('next で引っ掛けた token に対して処理漏れがある'); // @codeCoverageIgnore
            }
        }
        return array_map(function ($namespace) {
            return array_replace([
                '@comment' => '',
                '@using'   => [],
                '@const'   => [],
            ], $namespace);
        }, $result);
    }
}
