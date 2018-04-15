<?php

/** Don't touch this code. This is auto generated. */

namespace ryunosuke\Documentize\Utils;

class Classobj
{
    /**
     * 初期フィールド値を与えて stdClass を生成する
     *
     * 手元にある配列でサクッと stdClass を作りたいことがまれによくあるはず。
     *
     * object キャストでもいいんだが、 Iterator/Traversable とかも stdClass 化したいかもしれない。
     * それにキャストだとコールバックで呼べなかったり、数値キーが死んだりして微妙に使いづらいところがある。
     *
     * Example:
     * ```php
     * // 基本的には object キャストと同じ
     * $fields = ['a' => 'A', 'b' => 'B'];
     * assertEquals(stdclass($fields), (object) $fields);
     * // ただしこういうことはキャストでは出来ない
     * assertEquals(array_map('stdclass', [$fields]), [(object) $fields]); // コールバックとして利用する
     * assertTrue(property_exists(stdclass(['a', 'b']), '0')); // 数値キー付きオブジェクトにする
     * ```
     *
     * @package ClassObject
     *
     * @param array|\Traversable $fields フィールド配列
     * @return \stdClass 生成した stdClass インスタンス
     */
    public static function stdclass($fields = [])
    {
        $stdclass = new \stdClass();
        foreach ($fields as $key => $value) {
            $stdclass->$key = $value;
        }
        return $stdclass;
    }

    /**
     * ディレクトリ構造から名前空間を推測して返す
     *
     * 指定パスに名前空間を持つような php ファイルが有るならその名前空間を返す。
     * 指定パスに名前空間を持つような php ファイルが無いなら親をたどる。
     * 親に名前空間を持つような php ファイルが有るならその名前空間＋ローカルパスを返す。
     *
     * 言葉で表すとややこしいが、「そのパスに配置しても違和感の無い名前空間」を返してくれるはず。
     *
     * @package ClassObject
     *
     * @param string $location 配置パス。ファイル名を与えるとそのファイルを配置すべきクラス名を返す
     * @return string 名前空間
     */
    public static function detect_namespace($location)
    {
        // php をパースして名前空間部分を得るクロージャ
        $detectNS = function ($phpfile) {
            $tokens = token_get_all(file_get_contents($phpfile));
            $count = count($tokens);

            $namespace = [];
            foreach ($tokens as $n => $token) {
                if (is_array($token) && $token[0] === T_NAMESPACE) {
                    // T_NAMESPACE と T_WHITESPACE で最低でも2つは読み飛ばしてよい
                    for ($m = $n + 2; $m < $count; $m++) {
                        // よほどのことがないと T_NAMESPACE の次の T_STRING は名前空間の一部
                        if (is_array($tokens[$m]) && $tokens[$m][0] === T_STRING) {
                            $namespace[] = $tokens[$m][1];
                        }
                        // 終わりが来たら結合して返す
                        if ($tokens[$m] === ';') {
                            return implode('\\', $namespace);
                        }
                    }
                }
            }
            return null;
        };

        // 指定パスの兄弟ファイルを調べた後、親ディレクトリを辿っていく
        $basenames = [];
        return call_user_func(dirname_r, $location, function ($directory) use ($detectNS, &$basenames) {
            foreach (array_filter(glob("$directory/*.php"), 'is_file') as $file) {
                $namespace = $detectNS($file);
                if ($namespace !== null) {
                    $localspace = implode('\\', array_reverse($basenames));
                    return rtrim($namespace . '\\' . $localspace, '\\');
                }
            }
            $basenames[] = pathinfo($directory, PATHINFO_FILENAME);
        }) ?: call_user_func(throws, new \InvalidArgumentException('can not detect namespace. invalid output path or not specify namespace.'));
    }

    /**
     * composer のクラスローダを返す
     *
     * かなり局所的な実装で vendor ディレクトリを変更していたりするとそれだけで例外になる。
     *
     * Example:
     * ```php
     * assertInstanceof(\Composer\Autoload\ClassLoader::class, class_loader());
     * ```
     *
     * @package ClassObject
     *
     * @param string $startdir 高速化用の検索開始ディレクトリを指定するが、どちらかと言えばテスト用
     * @return \Composer\Autoload\ClassLoader クラスローダ
     */
    public static function class_loader($startdir = null)
    {
        $file = call_user_func(cache, 'path', function () use ($startdir) {
            $dir = $startdir ?: __DIR__;
            while ($dir !== ($pdir = dirname($dir))) {
                $dir = $pdir;
                if (file_exists($file = "$dir/autoload.php") || file_exists($file = "$dir/vendor/autoload.php")) {
                    $cache = $file;
                    break;
                }
            }
            if (!isset($cache)) {
                throw new \DomainException('autoloader is not found.');
            }
            return $cache;
        }, __FUNCTION__);
        return require $file;
    }

    /**
     * クラスの名前空間部分を取得する
     *
     * Example:
     * ```php
     * assertSame(class_namespace('vendor\\namespace\\ClassName'), 'vendor\\namespace');
     * ```
     *
     * @package ClassObject
     *
     * @param string|object $class 対象クラス・オブジェクト
     * @return string クラスの名前空間
     */
    public static function class_namespace($class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        $parts = explode('\\', $class);
        array_pop($parts);
        return ltrim(implode('\\', $parts), '\\');
    }

    /**
     * クラスの名前空間部分を除いた短い名前を取得する
     *
     * Example:
     * ```php
     * assertSame(class_shorten('vendor\\namespace\\ClassName'), 'ClassName');
     * ```
     *
     * @package ClassObject
     *
     * @param string|object $class 対象クラス・オブジェクト
     * @return string クラスの短い名前
     */
    public static function class_shorten($class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        $parts = explode('\\', $class);
        return array_pop($parts);
    }

    /**
     * 既存（未読み込みに限る）クラスを強制的に置換する
     *
     * 例えば継承ツリーが下記の場合を考える。
     *
     * classA <- classB <- classC
     *
     * この場合、「classC は classB に」「classB は classA に」それぞれ依存している、と考えることができる。
     * これは静的に決定的であり、この依存を壊したり注入したりする手段は存在しない。
     * 例えば classA の実装を差し替えたいときに、いかに classA を継承した classAA を定義したとしても classB の親は classA で決して変わらない。
     *
     * この関数を使うと本当に classA そのものを弄るので、継承ツリーを下記のように変えることができる。
     *
     * classA <- classAA <- classB <- classC
     *
     * つまり、classA を継承した classAA を定義してそれを classA とみなすことが可能になる。
     * ただし、内部的には class_alias を使用して実現しているので厳密には異なるクラスとなる。
     *
     * 実際のところかなり強力な機能だが、同時にかなり黒魔術的なので乱用は控えたほうがいい。
     *
     * @package ClassObject
     *
     * @param string $class 対象クラス名
     * @param \Closure $register 置換クラスを定義 or 返すクロージャ。「返せる」のは php7.0 以降のみ
     * @param string $dirname 一時ファイル書き出しディレクトリ。指定すると実質的にキャッシュとして振る舞う
     */
    public static function class_replace($class, $register, $dirname = null)
    {
        $class = ltrim($class, '\\');

        // 読み込み済みクラスは置換できない（php はクラスのアンロード機能が存在しない）
        if (class_exists($class, false)) {
            throw new \DomainException("'$class' is already declared.");
        }

        // 対象クラス名をちょっとだけ変えたクラスを用意して読み込む
        $classfile = call_user_func(class_loader)->findFile($class);
        $fname = rtrim(($dirname ?: sys_get_temp_dir()), '/\\') . '/' . str_replace('\\', '/', $class) . '.php';
        if (func_num_args() === 2 || !file_exists($fname)) {
            $content = file_get_contents($classfile);
            $content = preg_replace("#class\\s+[a-z0-9_]+#ui", '$0_', $content);
            call_user_func(file_set_contents, $fname, $content);
        }
        require_once $fname;

        $classess = get_declared_classes();
        $newclass = $register();

        // クロージャ内部でクラス定義した場合（増えたクラスでエイリアスする）
        if ($newclass === null) {
            $classes = array_diff(get_declared_classes(), $classess);
            if (count($classes) !== 1) {
                throw new \DomainException('declared multi classes.');
            }
            $newclass = reset($classes);
        }
        // php7.0 から無名クラスが使えるのでそのクラス名でエイリアスする
        if (is_object($newclass)) {
            /** @noinspection PhpUnusedLocalVariableInspection */
            $newclass = get_class($newclass);
        }

        class_alias($newclass, $class);
    }
}
