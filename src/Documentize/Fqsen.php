<?php

namespace ryunosuke\Documentize;

/**
 * 相対参照とか同一ファイル内の型指定で遅延評価せざるを得ないので型を表すクラス
 */
class Fqsen
{
    /** @var array php の内部タイプヒンティング */
    const BUILTIN_TYPES = [
        'void'     => true,
        'null'     => true,
        'number'   => true,
        'int'      => true,
        'integer'  => true,
        'float'    => true,
        'double'   => true,
        'bool'     => true,
        'boolean'  => true,
        'true'     => true,
        'false'    => true,
        'string'   => true,
        'resource' => true,
        'callable' => true,
        'iterable' => true,
        'array'    => true,
        'object'   => true,
        'mixed'    => true,
        'list'     => true, // 内部型ではないが頻出するので特別扱いする
    ];

    /** @var array phpdoc 特有のタイプヒンティング */
    const OWN_WORDS = [
        '$this'  => true,
        'self'   => true,
        'static' => true,
    ];

    /** @var array 遅延評価対象の型候補 */
    private $types = [];

    /**
     * 型の種別を返す
     *
     * @param string $type 型名
     * @return string|null 存在するならその型種別。存在しないなら null
     */
    public static function detectType($type)
    {
        if (!strlen(trim($type, "\\"))) {
            return null;
        }

        if (class_exists($type)) {
            return 'class';
        }
        if (trait_exists($type)) {
            return 'trait';
        }
        if (interface_exists($type)) {
            return 'interface';
        }
        return null;
    }

    /**
     * FQSEN を各要素に分解する
     *
     * 足りない要素は null で埋められる
     *
     * @param string $fqsen 完全修飾指定文字列
     * @return array [category, namespace, typename, member]
     */
    public static function parse($fqsen)
    {
        $fqsen = ltrim($fqsen, '?');
        $fqsen = strstr($fqsen . '<', '<', true);
        $fqsen = strstr($fqsen . '{', '{', true);

        if (isset(self::BUILTIN_TYPES[strtolower($fqsen)])) {
            return ['pseudo', '', $fqsen, 'todo'];
        }

        $regex = "
            (?<namespace>[^:()$]+\\\\)?
            (?<localname>[^:()$]+)
            (?:::
              (?<pmark>\\$)?(?<member>[^:()$]+)
            )?
            (?<fmark>\\(.*\\))?
        ";
        $match = preg_capture("#^$regex\$#ux", $fqsen, [
            'namespace' => '',   // 名前空間
            'localname' => '',   // ローカル名
            'member'    => null, // メンバー名
            'pmark'     => '',   // プロパティを表す $
            'fmark'     => '',   // callble を表す ()
        ]);

        // \\ で終わるものは超特別扱いで名前空間とする
        if (ends_with($match['localname'], '\\')) {
            $category = 'namespace';
        }
        // member が無いならグローバルのなにか
        elseif (strlen($match['member'] ?? '') === 0) {
            if (strlen($match['fmark'])) {
                $category = 'function';
            }
            // ClassName と CONST_NAME を判断する術はない。定義されているか、敢えて言うならすべて大文字なら定数
            elseif (const_exists($fqsen) || preg_match('#^[A-Z_0-9]+$#', $match['localname'])) {
                $category = 'constant';
            }
            else {
                $category = 'class';
            }
        }
        // member が有るならクラスメンバーのなにか
        else {
            if (strlen($match['pmark'])) {
                $category = 'property';
            }
            // Const と Method を判断する術はない（厳密には Method の FQSEN は () が必須だが付いていないプロダクトがあまりにも多い）
            elseif (const_exists($fqsen) || (!strlen($match['fmark']) && preg_match('#^[A-Z_0-9]+$#', $match['member']))) {
                $category = 'classconstant';
            }
            else {
                $category = 'method';
            }
        }
        return [$category, rtrim($match['namespace'], '\\'), ltrim($match['localname'], '\\'), $match['member']];
    }

    public function __construct($type = null)
    {
        if ($type !== null) {
            $this->add($type);
        }
    }

    /**
     * 型を加える
     *
     * @param string|self $type 型文字列
     */
    public function add($type)
    {
        if ($type instanceof Fqsen) {
            $type = $type->types;
        }
        $this->types = array_merge($this->types, (array) $type);
    }

    /**
     * 相対型指定を絶対型に変換する
     *
     * @param array $usings ファイルと名前空間のマッピング配列
     * @param string $namespace 所属する名前空間
     * @param string $own そのコンテキストにおける $this, static などが表す型
     * @return array 絶対型配列
     */
    public function resolve($usings, $namespace, $own)
    {
        // 配列化したりパイプをバラしたりして正規化
        $types = array_reduce($this->types, static function ($carry, $item) {
            return array_merge($carry, quoteexplode('|', $item, null, ['<' => '>', '{' => '}']));
        }, []);

        $result = [];
        foreach (array_filter(array_unique($types), 'strlen') as $type) {
            $nullable = false;
            if ($type[0] === '?') {
                $nullable = true;
                $type = substr($type, 1);
            }
            // Type[][] などの [] の数を配列階層数とする（ただし、パースに邪魔なので、置換して回数を数えておきそれを階層数とする）
            $fqsen = str_replace('[]', '', trim($type), $count);
            $fqsen = strstr($fqsen . '<', '<', true);
            $fqsen = strstr($fqsen . '{', '{', true);
            [$class, $member] = explode('::', $fqsen) + [1 => ''];
            $default = [
                'category' => 'type',
                'fqsen'    => ltrim($class, '\\'),
                'array'    => $count,
                'nullable' => $nullable,
            ];
            // array, callable などの組み込み型
            if (isset(self::BUILTIN_TYPES[strtolower($class)])) {
                $default['category'] = 'pseudo';
            }
            // $this, static などの自身を表す型
            elseif (isset(self::OWN_WORDS[strtolower($class)])) {
                $default['fqsen'] = $own;
            }

            // サブ use（読み替えて↓へフォールスルー）
            if ($class[0] !== '\\') {
                $parts = explode('\\', $class, 2);
                if (isset($parts[1]) && isset($usings[$namespace][$parts[0]])) {
                    $class = $usings[$namespace][$parts[0]] . '\\' . $parts[1];
                }
                elseif (self::detectType($namespace . '\\' . $class)) {
                    $class = $namespace . '\\' . $class;
                }
            }
            // use 節による読み替え型（読み替えて↓へフォールスルー）
            if (isset($usings[$namespace][$class])) {
                $class = $usings[$namespace][$class];
            }
            // 型が導けるならそれを使う
            if ($dtype = self::detectType($class)) {
                $default['category'] = $dtype;
                $default['fqsen'] = Reflection::instance($class)->getFqsen();
            }

            if ($member) {
                $member = preg_replace('#\(.*\)$#', '', $member, 1, $mc);
                if ($mc === 0 && const_exists("{$default['fqsen']}::$member")) {
                    $default['category'] = 'classconstant';
                    $default['fqsen'] .= '::' . $member;
                }
                elseif ($member[0] === '$') {
                    $default['category'] = 'property';
                    $default['fqsen'] .= '::' . $member;
                }
                else {
                    $default['category'] = 'method';
                    $default['fqsen'] .= '::' . $member . '()';
                }
            }
            elseif (!isset(self::BUILTIN_TYPES[strtolower($fqsen)])) {
                $fqsen = preg_replace('#\(.*\)$#', '', $fqsen, 1, $mc);
                if ($mc === 0 && const_exists($fqsen)) {
                    $default['category'] = 'constant';
                    $default['fqsen'] = $fqsen;
                }
                elseif (function_exists($fqsen)) {
                    $default['category'] = 'function';
                    $default['fqsen'] = $fqsen . '()';
                }
            }

            $result[] = $default;
        }
        return $result;
    }
}
