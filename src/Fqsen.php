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
        $category = 'type';
        $typename = trim($fqsen);
        $member = null;
        $parts = explode('::', $typename);
        if (isset($parts[1])) {
            $typename = $parts[0];
            $member = preg_replace('#\(.*\)$#', '', $parts[1], 1, $mc);
            // 定義されているなら定数
            if ($mc === 0 && defined("$typename::$member")) {
                $category = 'constant';
            }
            // $ 付きはプロパティ
            elseif ($member[0] === '$') {
                $category = 'property';
            }
            // それ以外はメソッド
            else {
                $category = 'method';
                $member .= '()';
            }
        }

        // 名前空間なのかクラスなのかの厳密な区別は存在しない。存在チェックするしかない
        if ($member || self::detectType($typename)) {
            $parts = explode('\\', $typename);
            $typename = array_pop($parts);
            $namespace = implode('\\', $parts);
        }
        else {
            $category = 'namespace';
            $namespace = $typename;
            $typename = null;
        }

        return [$category, $namespace, $typename, $member];
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
            return array_merge($carry, explode('|', $item));
        }, []);

        $result = [];
        foreach (array_filter(array_unique($types), 'strlen') as $type) {
            // Type[][] などの [] の数を配列階層数とする（ただし、パースに邪魔なので、置換して回数を数えておきそれを階層数とする）
            $fqsen = str_replace('[]', '', trim($type), $count);
            list($class, $member) = explode('::', $fqsen) + [1 => ''];
            $default = [
                'category' => 'type',
                'fqsen'    => $class,
                'array'    => $count,
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
                $refclass = new \ReflectionClass($class);
                $default['category'] = $dtype;
                $default['fqsen'] = ($refclass->isInternal() ? '\\' : '') . $refclass->getName();
            }

            if ($member) {
                $member = preg_replace('#\(.*\)$#', '', $member, 1, $mc);
                if ($mc === 0 && defined("{$default['fqsen']}::$member")) {
                    $default['category'] = 'constant';
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
            $result[] = $default;
        }
        return $result;
    }
}
