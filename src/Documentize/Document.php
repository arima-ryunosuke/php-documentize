<?php

namespace ryunosuke\Documentize;

use Symfony\Component\Process\Process;

class Document
{
    const GLOBAL_MULTIPLES = [
        'constant' => 'constants',
        'function' => 'functions',
    ];
    const TYPE_MULTIPLES   = [
        'class'     => 'classes',
        'trait'     => 'traits',
        'interface' => 'interfaces',
    ];
    const MEMBER_MULTIPLES = [
        'classconstant' => 'classconstants',
        'property'      => 'properties',
        'method'        => 'methods',
    ];

    /** @var array 動作オプション */
    private $options = [];

    /** @var array 名前空間ごとの use 節マッピング */
    private $usings = [];

    /** @var array 掻き集めてる最中の fqsen */
    private $fqsens = [];

    /** @var string 掻き集めてるディレクトリ */
    private $targetdir, $targethash;

    /** @var array 掻き集めてる最中の markdown（フィールドで抱えるのは最高に気持ち悪いのでリファクタ対象） */
    private $markdowns = [];

    public static function gatherIsolative($options, &$logs = null)
    {
        $outfile = tempnam(sys_get_temp_dir(), 'rdz');
        $process = new Process([
            PHP_BINARY,
            '-r',
            'require_once ' . var_export(__DIR__ . '/../../vendor/autoload.php', true) . ';
$document = new \\ryunosuke\\Documentize\\Document(unserialize(stream_get_contents(STDIN)));
$gathertime = microtime(true);
$readcount = count(get_included_files());
$dataarray = $document->gather($logs);
file_put_contents(' . var_export($outfile, true) . ', serialize([
    "result"     => $dataarray,
    "logs"       => $logs,
    "memory"     => memory_get_peak_usage(true),
    "time"       => microtime(true) - $gathertime,
    "read"       => count(get_included_files()) - $readcount,
]));',
        ]);
        $process->setInput(serialize($options));
        $process->run();
        echo $process->getOutput();
        $logs = $process->getErrorOutput();
        if (!$process->isSuccessful() || $logs) {
            @unlink($outfile);
            return false;
        }
        $result = unserialize(file_get_contents($outfile));
        unlink($outfile);
        return $result;
    }

    public function __construct($options)
    {
        // 差分を取る関係上、自身が使うクラスは読み込んでおく必要がある
        class_exists(Fqsen::class, true);
        class_exists(PhpFile::class, true);
        class_exists(Reflection::class, true);
        class_exists(Tag::class, true);

        $this->options = array_replace([
            'target'                      => null,
            'autoloader'                  => null,
            'recursive'                   => false,
            'include'                     => [],
            'exclude'                     => [],
            'contain'                     => [],
            'except'                      => [],
            'cachedir'                    => null,
            'no-constant'                 => false,
            'no-function'                 => false,
            'no-internal-constant'        => false,
            'no-internal-function'        => false,
            'no-internal-type'            => false,
            'no-internal-classconstant'   => false,
            'no-internal-property'        => false,
            'no-internal-method'          => false,
            'no-deprecated-constant'      => false,
            'no-deprecated-function'      => false,
            'no-deprecated-type'          => false,
            'no-deprecated-classconstant' => false,
            'no-deprecated-property'      => false,
            'no-deprecated-method'        => false,
            'no-magic-property'           => false,
            'no-magic-method'             => false,
            'no-virtual-classconstant'    => false,
            'no-virtual-property'         => false,
            'no-virtual-method'           => false,
            'no-private-classconstant'    => false,
            'no-private-property'         => false,
            'no-private-method'           => false,
            'no-protected-classconstant'  => false,
            'no-protected-property'       => false,
            'no-protected-method'         => false,
            'no-public-classconstant'     => false,
            'no-public-property'          => false,
            'no-public-method'            => false,
        ], $options);

        if (!file_exists($this->options['target'])) {
            throw new \InvalidArgumentException("{$this->options['target']} is not found.");
        }

        if (is_dir($this->options['target'])) {
            $this->targetdir = realpath($this->options['target']);
            $this->targethash = sha1($this->targetdir);
        }
        else {
            $this->targetdir = realpath(dirname($this->options['target']));
            $this->targethash = sha1($this->targetdir);
        }

        if ($this->options['cachedir']) {
            cachedir($this->options['cachedir'] . '/rfc');
        }

        // rsync を真似ようとしたが思ったより複雑だったのでシンプルに「すべて * をプレフィックス」という仕様にする
        $this->options['include'] = array_map(function ($v) { return "*$v"; }, (array) $this->options['include']);
        $this->options['exclude'] = array_map(function ($v) { return "*$v"; }, (array) $this->options['exclude']);

        // 配列化して * を付ける
        $this->options['contain'] = (array) $this->options['contain'];
        $this->options['contain'] = array_map(function ($v) { return "$v*"; }, $this->options['contain']);

        // 同上＋いくつかは recursive モードでどうしても付いてしまうので暗黙的に伏せる（こいつらを拡張することなんてほぼ無い）
        $this->options['except'] = (array) $this->options['except'];
        $this->options['except'][] = 'Composer\\Autoload';
        $this->options['except'] = array_map(function ($v) { return "$v*"; }, $this->options['except']);
    }

    /**
     * 指定されたディレクトリ・ファイルから情報を掻き集める
     *
     * このメソッドは「掻き集める」以上のことは一切しない。また、結果は全てプレーンな配列であり、オブジェクトを含んだりしない。
     * 具体的には markdown パースしたりシンタックスハイライトしたり活きた Tag オブジェクトを持ったり等。
     * それらは生成側の仕事であり、「集めるもの」の仕事ではないというスタンス。
     *
     * @param array $logs 掻き集めてる最中のログが格納される
     * @return array 名前空間単位のメタ情報
     * @todo いろいろ拡張していたらいつのまにか参照地獄になっていたので綺麗に書き直す
     *
     */
    public function gather(&$logs = [])
    {
        $this->fqsens = [];
        $logs = [];

        // ロガーの代わりにエラーハンドラを使用する
        set_error_handler(static function ($errno, $errstr, $errfile, $errline) use (&$logs) {
            // @で抑止されてたら無視
            if (error_reporting() === 0) {
                return false;
            }
            // E_USER_DEPRECATED はログらない（警告的なものが多いので報告したところでアクションが取れない）
            if ($errno === E_USER_DEPRECATED) {
                return;
            }
            $logs[] = [
                'errorno' => $errno,
                'message' => $errstr,
                'file'    => $errfile,
                'line'    => $errline,
            ];
        });

        // 定義済みを読み込んでおく（組み込みや自分自身で使うやつを除外するため）
        $loaded_constants = get_defined_constants();
        $loaded_functions = get_defined_functions()['user'];
        $loaded_interfaces = get_declared_interfaces();
        $loaded_traits = get_declared_traits();
        $loaded_classes = get_declared_classes();

        // オートローダを登録して対象を全て読み漁る
        if (file_exists($this->options['autoloader'])) {
            require_once $this->options['autoloader'];
        }
        if (is_dir($this->options['target'])) {
            foreach (file_list($this->options['target']) as $file) {
                $this->parseFile($file);
            }
        }
        else {
            $this->parseFile($this->options['target']);
        }

        // 1パス目。名前空間に属する「定数」「関数」「インターフェース」「トレイト」「クラス」を掻き集める
        $namespaces = [];
        $hierarchies = [
            'class'     => [],
            'interface' => [],
            'trait'     => [],
        ];
        do {
            $constants = array_diff_key(get_defined_constants(), $loaded_constants);
            $functions = array_diff(get_defined_functions()['user'], $loaded_functions);
            $interfaces = array_diff(get_declared_interfaces(), $loaded_interfaces);
            $traits = array_diff(get_declared_traits(), $loaded_traits);
            $classes = array_diff(get_declared_classes(), $loaded_classes);
            $loaded_constants = array_merge($loaded_constants, $constants);
            $loaded_functions = array_merge($loaded_functions, $functions);
            $loaded_interfaces = array_merge($loaded_interfaces, $interfaces);
            $loaded_traits = array_merge($loaded_traits, $traits);
            $loaded_classes = array_merge($loaded_classes, $classes);
            $loadcount = $this->parse($namespaces, $hierarchies, $constants, $functions, $interfaces, $traits, $classes);
        } while ($this->options['recursive'] && $loadcount);

        // 2パス目。階層構造のツリー化
        foreach (['class', 'interface', 'trait'] as $treekey) {
            $tree = &$hierarchies[$treekey];
            array_walk($tree, $h = static function (&$target) use (&$h, &$tree) {
                foreach ($target as $parent => &$children) {
                    if (isset($tree[$parent])) {
                        $children = $tree[$parent];
                        $h($children);
                        unset($tree[$parent]);
                    }
                }
            });
        }

        // 3パス目。走査中に継承・引用したりは出来ないのでこのタイミングでやる
        $inheritdoc = function (&$target, $mtype) use (&$namespaces, &$inheritdoc) {
            if (isset($target['tags']['inheritdoc'][0])) {
                $doctag = $target['tags']['inheritdoc'][0];
                if ($doctag['type']) {
                    $tfqsen = $doctag['type']['fqsen'];
                }
                else {
                    $ref = Reflection::instance($target['fqsen']);
                    $pt = $ref->getProtoType();
                    if (!$pt) {
                        if ($doctag['inline']) {
                            $target['description'] = str_replace('HereIsInheritdoc', '', $target['description']);
                        }
                        trigger_error("{$target['fqsen']} uses inheritdoc, but prototype is not found.");
                        return;
                    }
                    $tfqsen = $pt->getFqsen();
                }
            }
            elseif (($mtype === 'properties' || $mtype === 'methods') && !$target['magic'] && !$target['tags'] && !trim($target['description'])) {
                $doctag = ['inline' => false];
                $ref = Reflection::instance($target['fqsen']);
                $pt = $ref->getProtoType();
                if (!$pt) {
                    return;
                }
                $tfqsen = $pt->getFqsen();
            }
            else {
                return;
            }
            list(, $ns, $cname, $member) = Fqsen::parse(rtrim($tfqsen, '()'));
            $OK = false;
            foreach (self::TYPE_MULTIPLES as $type) {
                if ($mtype === 'type') {
                    if (!isset($namespaces[$ns][$type][$cname])) {
                        continue;
                    }
                    $parent = &$namespaces[$ns][$type][$cname];
                }
                else {
                    if (!isset($namespaces[$ns][$type][$cname][$mtype][$member])) {
                        continue;
                    }
                    $parent = &$namespaces[$ns][$type][$cname][$mtype][$member];
                }
                // 親が @inheritdoc している可能性もあるので再帰する
                if ($parent !== $target) {
                    $inheritdoc($parent, $mtype);
                }

                // インラインは置換ではなく埋め込み。インラインでないなら完全置換
                if ($doctag['inline']) {
                    // ただし、文言指定されているなら親ではなくそれを使う
                    $parentdoc = $doctag['description'] ?: trim($parent['description']);
                    $target['description'] = str_replace('HereIsInheritdoc', $parentdoc, $target['description']);
                }
                else {
                    // ただし、子供自身の記述を活かしたい場合もあるので空の場合のみ
                    if (!trim($target['description'])) {
                        $target['description'] = $parent['description'];
                    }
                }

                // タグは要素を問わずすべて継承
                $target['tags'] = $parent['tags'];

                if ($mtype === 'type') {
                    // dummy. 型で継承したい要素があるならここに記述
                }
                elseif ($mtype === 'constants') {
                    // dummy. 定数で継承したい要素があるならここに記述
                }
                elseif ($mtype === 'properties') {
                    // dummy. プロパティで継承したい要素があるならここに記述
                }
                elseif ($mtype === 'methods') {
                    // メソッドは引数と返り値を継承（空の場合のみ）
                    $parentparams = array_column($parent['parameters'], null, 'name');
                    foreach ($target['parameters'] as $n => $parameter) {
                        if (isset($parentparams[$parameter['name']]) && !$parameter['description']) {
                            $target['parameters'][$n] = $parentparams[$parameter['name']];
                        }
                    }
                    if (!$target['return']['types']) {
                        $target['return'] = $parent['return'];
                    }
                }

                $OK = true;
                break;
            }
            if (!$OK) {
                if ($doctag['inline']) {
                    $target['description'] = str_replace('HereIsInheritdoc', '', $target['description']);
                }
                // 内部クラスの doccomment は取れないのでエラーは必然。なのでログらない
                if ($tfqsen[0] !== '\\') {
                    trigger_error("{$target['fqsen']} uses inheritdoc, but $tfqsen is not found.");
                }
            }
        };
        foreach ($namespaces as $namespace => &$elements) {
            foreach (self::TYPE_MULTIPLES as $type) {
                foreach (self::MEMBER_MULTIPLES as $mtype) {
                    foreach ($elements[$type] as &$typeArray) {
                        $inheritdoc($typeArray, 'type');
                        foreach ($typeArray[$mtype] as &$member) {
                            $inheritdoc($member, $mtype);
                        }
                    }
                }
            }
        }

        // 4パス目。この時点ですべて出来上がっているので lookup したり最終調整
        $marshal = static function (&$typeArray) use ($hierarchies, &$namespaces) {
            $lookup = static function ($fqsen) use (&$namespaces) {
                list($category, $ns, $cname, $member) = Fqsen::parse($fqsen);
                foreach (self::MEMBER_MULTIPLES as $cate => $key) {
                    if ($category === $cate) {
                        return null
                            ?? $namespaces[$ns]['interfaces'][$cname][$key][$member]
                            ?? $namespaces[$ns]['traits'][$cname][$key][$member]
                            ?? $namespaces[$ns]['classes'][$cname][$key][$member]
                            ?? null;
                    }
                }
                return null
                    ?? $namespaces[$ns]['interfaces'][$cname]
                    ?? $namespaces[$ns]['traits'][$cname]
                    ?? $namespaces[$ns]['classes'][$cname]
                    ?? null;
            };
            $containtree = static function ($key, $tree) use (&$containtree) {
                foreach ($tree as $k => $node) {
                    if ($key === $k) {
                        return true;
                    }
                    if ($containtree($key, $node)) {
                        return true;
                    }
                }
            };

            foreach (self::MEMBER_MULTIPLES as $mtype) {
                foreach ($typeArray[$mtype] as &$member) {
                    foreach ($member['prototypes'] as &$prototype) {
                        $prototype['description'] = $lookup($prototype['fqsen'])['description'] ?? '';
                    }
                }
            }
            foreach ($hierarchies[$typeArray['category']] as $parent => $child) {
                if ($containtree($typeArray['fqsen'], [$parent => $child])) {
                    $typeArray['hierarchy'][$parent] = $child;
                }
            }
            foreach (['parents', 'implements', 'uses'] as $construction) {
                array_walk($typeArray[$construction], static function (&$fqsen) use ($lookup) {
                    $type = $lookup($fqsen);
                    $fqsen = [
                        'fqsen'       => $fqsen,
                        'category'    => $type['category'] ?? null,
                        'description' => $type['description'] ?? null,
                    ];
                });
            }
        };
        $result = [];
        ksort($namespaces);
        foreach ($namespaces as $namespace => $data) {
            if ($this->skip($data, null, null)) {
                continue;
            }
            foreach (self::GLOBAL_MULTIPLES as $name => $key) {
                foreach ($data[$key] as $n => $e) {
                    if ($this->skip($e, null, $name)) {
                        unset($data[$key][$n]);
                    }
                }
            }
            foreach (self::TYPE_MULTIPLES as $key) {
                foreach ($data[$key] as $n => $e) {
                    if ($this->skip($e, null, 'type')) {
                        unset($data[$key][$n]);
                        continue;
                    }
                    foreach (self::MEMBER_MULTIPLES as $name2 => $key2) {
                        foreach ($e[$key2] as $n2 => $e2) {
                            if ($this->skip($e2, $e, $name2)) {
                                unset($data[$key][$n][$key2][$n2]);
                            }
                        }
                    }
                }
            }

            // 環境によって関数の定義順がバラけるようなので functions だけは定義順でソート
            uasort($data['functions'], function ($a, $b) { return $a['location']['start'] - $b['location']['start']; });

            foreach (self::TYPE_MULTIPLES as $type) {
                array_walk($data[$type], $marshal);
            }

            $nsdescription = array_reduce(PhpFile::cache(null), function ($carry, $filedata) use ($namespace) {
                return $carry . concat($filedata[$namespace]['@comment'] ?? '', "\n\n");
            });
            $nsdata = $this->parseDoccomment($nsdescription, $namespace, null);
            $data['description'] = $nsdata['description'];
            $data['tags'] = $nsdata['tags'];

            $mns = [];
            $tmp = &$result;
            $nss = preg_split('#\\\\#', $data['namespace'], -1, PREG_SPLIT_NO_EMPTY);
            foreach ($nss as $ns) {
                $mns[] = $ns;
                if (!isset($tmp[$ns])) {
                    $tmp[$ns] = $this->defaultNS(ltrim(implode('\\', $mns), '\\'));
                }
                $tmp = &$tmp[$ns]['namespaces'];
            }
            $tmp[$data['name']] = $data;
        }

        // 5パス目。過程で見つからなかった FQSEN を報告
        foreach ($this->fqsens as $type => $fqsens) {
            foreach ($fqsens as $fqsen) {
                list($category, $ns, $cname, $m) = Fqsen::parse($fqsen);
                if ($ttype = Fqsen::detectType("$ns\\$cname")) {
                    $ref = Reflection::instance("$ns\\$cname");
                    if (!$ref->isInternal()) {
                        if ($m === null) {
                            $category = self::TYPE_MULTIPLES[$ttype];
                            if (!isset($namespaces[$ns][$category][$cname])) {
                                trigger_error("'$fqsen' is unknown type in ($type)");
                            }
                        }
                        else {
                            $category2 = self::MEMBER_MULTIPLES[$category];
                            $category = self::TYPE_MULTIPLES[$ttype];
                            if (!isset($namespaces[$ns][$category][$cname][$category2][$m])) {
                                trigger_error("'$fqsen' is unknown member in ($type)");
                            }
                        }
                    }
                }
                elseif ($category !== 'pseudo' && $category !== 'namespace' && $category !== 'constant' && $category !== 'function') {
                    trigger_error("'$fqsen' is undefined type in ($type)");
                }
            }
        }

        restore_error_handler();

        return [
            'namespaces' => $result,
            'markdowns'  => $this->markdowns,
        ];
    }

    private function cache($id, $originaltime, $provider)
    {
        if (!$this->options['cachedir']) {
            return $provider();
        }

        $cachename = $this->options['cachedir'] . "/{$this->targethash}/" . rawurlencode($id);
        if (!$this->options['force'] && file_exists($cachename) && filemtime($cachename) > $originaltime) {
            return unserialize(file_get_contents($cachename)); // @codeCoverageIgnore
        }

        $usings = $provider();
        file_set_contents($cachename, serialize($usings));
        return $usings;
    }

    private function defaultNS($namespace)
    {
        list($ns, $name) = namespace_split($namespace);
        return [
            'category'    => 'namespace',
            'fqsen'       => "$namespace\\",
            'namespace'   => $ns,
            'name'        => $name,
            'description' => '',
            'namespaces'  => [],
            'constants'   => [],
            'functions'   => [],
            'interfaces'  => [],
            'traits'      => [],
            'classes'     => [],
            'tags'        => [],
        ];
    }

    private function parse(&$namespaces, &$hierarchies, $constants, $functions, $interfaces, $traits, $classes)
    {
        $result = 0;
        foreach ($constants as $name => $value) {
            $ref = Reflection::instance([$name => $value]);

            $data = $this->parseConstant($ref, $ref->getNamespaceName(), null);
            $this->parseTag($data['tags']);

            $namespaces[$ref->getNamespaceName()] = $namespaces[$ref->getNamespaceName()] ?? $this->defaultNS($ref->getNamespaceName());
            $namespaces[$ref->getNamespaceName()]['constants'][$ref->getShortName()] = [
                'category'    => $ref->getCategory(),
                'fqsen'       => $ref->getFqsen(),
                'namespace'   => $ref->getNamespaceName(),
                'name'        => $ref->getShortName(),
                'location'    => $ref->getLocation(),
                'description' => $data['description'],
                'value'       => $data['value'],
                'accessible'  => $data['accessible'],
                'types'       => $data['types'],
                'tags'        => $data['tags'],
            ];
            $result++;
        }
        foreach ($functions as $name) {
            $ref = Reflection::instance("$name()");
            if (!file_exists($ref->getFileName())) {
                continue;
            }
            if (!$this->options['recursive'] && strpos($ref->getFileName(), $this->targetdir) !== 0) {
                continue;
            }

            $data = $this->cache($ref->getFqsen() . '.function', filemtime($ref->getFileName()), function () use ($ref) {
                return $this->parseFunction($ref, $ref->getNamespaceName(), null);
            });
            $this->parseTag($data['tags']);

            $namespaces[$ref->getNamespaceName()] = $namespaces[$ref->getNamespaceName()] ?? $this->defaultNS($ref->getNamespaceName());
            $namespaces[$ref->getNamespaceName()]['functions'][$ref->getShortName()] = [
                'category'    => $ref->getCategory(),
                'fqsen'       => $ref->getFqsen(),
                'namespace'   => $ref->getNamespaceName(),
                'name'        => $ref->getShortName(),
                'location'    => $ref->getLocation(),
                'description' => $data['description'],
                'parameters'  => $data['parameters'],
                'return'      => $data['return'],
                'tags'        => $data['tags'],
            ];
            $result++;
        }
        foreach ([$interfaces, $traits, $classes] as $types) {
            foreach ($types as $name) {
                if (strpos($name, '@anonymous') !== false) {
                    continue;
                }
                $ref = Reflection::instance($name);
                if (!file_exists($ref->getFileName())) {
                    continue;
                }
                if (!$this->options['recursive'] && strpos($ref->getFileName(), $this->targetdir) !== 0) {
                    continue;
                }

                $lasttime = $ref->getLastModified();
                $data = $this->cache($ref->getFqsen() . '.class', $lasttime, function () use ($ref) {
                    return $this->parseClass($ref);
                });
                $this->parseTag($data['tags']);

                foreach ($this->cache($ref->getFqsen() . '.classconstants', $lasttime, function () use ($ref) {
                    return $this->parseClassConstant($ref);
                }) as $n => $e) {
                    $this->parseTag($e['tags']);
                    $data['classconstants'][$n] = $e;
                }
                foreach ($this->cache($ref->getFqsen() . '.properties', $lasttime, function () use ($ref, $data) {
                    return $this->parseProperty($ref, $data['tags']['property'] ?? []);
                }) as $n => $e) {
                    $this->parseTag($e['tags']);
                    $data['properties'][$n] = $e;
                }
                foreach ($this->cache($ref->getFqsen() . '.methods', $lasttime, function () use ($ref, $data) {
                    return $this->parseMethod($ref, $data['tags']['method'] ?? []);
                }) as $n => $e) {
                    $this->parseTag($e['tags']);
                    $data['methods'][$n] = $e;
                }

                $category = self::TYPE_MULTIPLES[$data['category']];
                $namespaces[$ref->getNamespaceName()] = $namespaces[$ref->getNamespaceName()] ?? $this->defaultNS($ref->getNamespaceName());
                $namespaces[$ref->getNamespaceName()][$category][$ref->getShortName()] = $data;
                $result++;

                // トレイトに implement という概念はない
                if ($category !== 'traits') {
                    foreach ($data['implements'] as $t) {
                        $hierarchies['interface'][$t][$data['fqsen']] = [];
                    }
                }
                // インターフェースに use という概念はない
                if ($category !== 'interfaces') {
                    foreach ($data['uses'] as $t) {
                        $hierarchies['trait'][$t][$data['fqsen']] = [];
                    }
                }
                // 親という概念はクラスにしかない
                if ($category === 'classes') {
                    foreach ($data['parents'] as $t) {
                        $hierarchies['class'][$t][$data['fqsen']] = [];
                        break;
                    }
                }
            }
        }
        return $result;
    }

    private function parseFile($filename)
    {
        static $readfiles = [];

        if (!($filename = realpath($filename))) {
            return false;
        }
        if (isset($readfiles[$filename])) {
            return false;
        }
        if (!$this->options['recursive'] && strpos($filename, $this->targetdir) !== 0) {
            return false;
        }

        if ($this->options['include'] && !fnmatch_or($this->options['include'], $filename, FNM_NOESCAPE)) {
            return false;
        }
        if ($this->options['exclude'] && fnmatch_or($this->options['exclude'], $filename, FNM_NOESCAPE)) {
            return false;
        }

        if (in_array(strtolower(pathinfo($filename, PATHINFO_EXTENSION)), ['md', 'markdown'], true)) {
            $this->parseMarkdown($filename);
            return true;
        }

        require_once $filename;
        $readfiles[$filename] = true;

        $filecache = $this->cache("$filename.parsed", filemtime($filename), function () use ($filename) { return PhpFile::cache($filename); });
        PhpFile::cache($filename, $filecache);

        $usings = array_lookup($filecache, '@using');
        foreach ($usings as $ns => $using) {
            if (!isset($this->usings[$ns])) {
                $this->usings[$ns] = [];
            }
            $this->usings[$ns] += $using;
        }

        if ($this->options['recursive']) {
            array_walk_recursive($usings, function ($class) {
                if (Fqsen::detectType($class)) {
                    $ref = Reflection::instance($class);
                    if (!$ref->isInternal()) {
                        $this->parseFile($ref->getFileName());
                    }
                }
            });
        }

        return true;
    }

    private function parseConstant(Reflection $refconst, $namespace, $own)
    {
        $docs = $this->parseDoccomment($refconst->getDocComment(), $namespace, $own);

        return [
            'description' => $docs['description'] ?: $docs['tags']['var'][0]['description'] ?? '',
            'value'       => var_export2($refconst->getValue(), true),
            'accessible'  => 'public', // 取りようがない
            'types'       => (new Fqsen(var_type($refconst->getValue(), true)))->resolve($this->usings, $namespace, $own),
            'tags'        => $docs['tags'],
        ];
    }

    private function parseFunction(Reflection $reffunc, $namespace, $own)
    {
        $docs = $this->parseDoccomment($reffunc->getDocComment(), $namespace, $own);

        $result = [
            'description' => $docs['description'],
            'parameters'  => [],
            'return'      => [],
            'tags'        => $docs['tags'],
        ];

        $merge = static function (array $types, $type, $usings, $namespace, $own) {
            /** @var Reflection $type */
            $stype = $type->getFqsen();
            if ($stype === 'void') {
                return $types;
            }
            $fqsen = new Fqsen($stype);
            return array_values(array_unique(array_merge($fqsen->resolve($usings, $namespace, $own), $types), SORT_REGULAR));
        };

        $paramTags = array_column($docs['tags']['param'] ?? [], null, 'name');
        foreach ($reffunc->getParameters() as $param) {
            $result['parameters'][] = [
                'types'       => $merge($paramTags[$param->getShortName()]['type'] ?? [], $param->getType(), $this->usings, $namespace, $own),
                'name'        => $param->getShortName(),
                'declaration' => $param->getDeclaration(),
                'description' => $paramTags[$param->getShortName()]['description'] ?? '',
            ];
        }

        $result['return'] = [
            'types'       => $merge($docs['tags']['return'][0]['type'] ?? [], $reffunc->getType(), $this->usings, $namespace, $own),
            'description' => $docs['tags']['return'][0]['description'] ?? '',
        ];

        return $result;
    }

    private function parseClass(Reflection $refclass)
    {
        $classdocs = $this->parseDoccomment($refclass->getDocComment(), $refclass->getNamespaceName(), $refclass->getFqsen());

        $result = [
            'category'       => $refclass->getCategory(),
            'fqsen'          => $refclass->getFqsen(),
            'namespace'      => $refclass->getNamespaceName(),
            'name'           => $refclass->getShortName(),
            'location'       => $refclass->getLocation(),
            'description'    => $classdocs['description'],
            'final'          => $refclass->isFinal(),
            'abstract'       => $refclass->isAbstract(),
            'cloneable'      => false, // $refclass->isCloneable(), # php has bug called __destruct
            'iterateable'    => $refclass->isIterateable(),
            'hierarchy'      => [],
            'parents'        => $refclass->getParents(),
            'implements'     => $refclass->getImplements(),
            'uses'           => $refclass->getUses(),
            'classconstants' => [],
            'properties'     => [],
            'methods'        => [],
            'tags'           => $classdocs['tags'],
        ];

        return $result;
    }

    private function parseClassConstant(Reflection $refclass)
    {
        $result = [];
        foreach ($refclass->getConstants() as $refconst) {
            $decclass = $refconst->getDeclaringClass();
            $constdocs = $this->parseDoccomment($refconst->getDocComment(), $decclass->getNamespaceName(), $decclass->getFqsen());
            $types = $constdocs['tags']['var'][0]['type'] ?? (new Fqsen(var_type($refconst->getValue(), true)))->resolve($this->usings, $refclass->getNamespaceName(), $refclass->getFqsen());
            $prototypes = $refconst->getProtoTypes();
            $result[$refconst->getShortName()] = [
                'category'    => $refconst->getCategory(),
                'fqsen'       => $refconst->getFqsen(),
                'namespace'   => $refconst->getNamespaceName(),
                'name'        => $refconst->getShortName(),
                'location'    => $refconst->getLocation(),
                'description' => $constdocs['description'] ?: $constdocs['tags']['var'][0]['description'] ?? '',
                'value'       => var_export2($refconst->getValue(), true),
                'virtual'     => $prototypes && !in_array_or(['override'], array_column($prototypes, 'kind')),
                'accessible'  => $refconst->getAccessible(),
                'prototypes'  => $prototypes,
                'types'       => $types,
                'tags'        => $constdocs['tags'],
            ];
        }
        return $result;
    }

    private function parseProperty(Reflection $refclass, $magicTags)
    {
        $merge = static function (array $types, $type, $usings, $namespace, $own) {
            /** @var Reflection $type */
            $stype = $type->getFqsen();
            if ($stype === 'void') {
                return $types;
            }
            $fqsen = new Fqsen($stype);
            return array_values(array_unique(array_merge($fqsen->resolve($usings, $namespace, $own), $types), SORT_REGULAR));
        };

        $result = [];
        foreach ($refclass->getProperties() as $refproperty) {
            $decclass = $refproperty->getDeclaringClass();
            $propdocs = $this->parseDoccomment($refproperty->getDocComment(), $decclass->getNamespaceName(), $decclass->getFqsen());
            $prototypes = $refproperty->getProtoTypes();
            $result[$refproperty->getShortName()] = [
                'category'    => $refproperty->getCategory(),
                'fqsen'       => $refproperty->getFqsen(),
                'namespace'   => $refproperty->getNamespaceName(),
                'name'        => $refproperty->getShortName(),
                'location'    => $refproperty->getLocation(),
                'description' => $propdocs['description'] ?: $propdocs['tags']['var'][0]['description'] ?? '',
                'hasValue'    => $refproperty->hasValue(),
                'value'       => var_export2($refproperty->getValue(), true),
                'virtual'     => $prototypes && !in_array_or(['override'], array_column($prototypes, 'kind')),
                'magic'       => false,
                'static'      => $refproperty->isStatic(),
                'accessible'  => $refproperty->getAccessible(),
                'prototypes'  => $prototypes,
                'types'       => $merge($propdocs['tags']['var'][0]['type'] ?? [], $refproperty->getType(), $this->usings, $refclass->getNamespaceName(), $refclass->getFqsen()) ?: (new Fqsen(var_type($refproperty->getValue(), true)))->resolve($this->usings, $refclass->getNamespaceName(), $refclass->getFqsen()),
                'tags'        => $propdocs['tags'],
            ];
        }
        foreach ($magicTags as $tag) {
            // @property のパースに失敗している場合は設定されていない
            if (!isset($tag['name'])) {
                continue;
            }
            $propdocs = $this->parseDoccomment($tag['doccomment'], $refclass->getNamespaceName(), $refclass->getFqsen());
            $types = $propdocs['tags']['var'][0]['type'] ?? [];
            $result[$tag['name']] = [
                'category'    => 'property',
                'fqsen'       => $refclass->getFqsen() . '::$' . $tag['name'],
                'namespace'   => $refclass->getNamespaceName(),
                'name'        => $tag['name'],
                'location'    => $refclass->getMagicPropertyLocation($tag['name']),
                'description' => $propdocs['description'],
                'hasValue'    => false,
                'value'       => null,
                'virtual'     => false,
                'magic'       => true,
                'static'      => $tag['static'],
                'accessible'  => 'public',
                'prototypes'  => [],
                'types'       => $types,
                'tags'        => $propdocs['tags'],
            ];
        }
        return $result;
    }

    private function parseMethod(Reflection $refclass, $magicTags)
    {
        $result = [];
        foreach ($refclass->getMethods() as $refmethod) {
            $decclass = $refmethod->getDeclaringClass();
            $rmethod = $this->parseFunction($refmethod, $decclass->getNamespaceName(), $decclass->getFqsen());
            $prototypes = $refmethod->getProtoTypes();
            $result[$refmethod->getShortName()] = [
                'category'    => $refmethod->getCategory(),
                'fqsen'       => $refmethod->getFqsen(),
                'namespace'   => $refmethod->getNamespaceName(),
                'name'        => $refmethod->getShortName(),
                'location'    => $refmethod->getLocation(),
                'description' => $rmethod['description'],
                'virtual'     => $prototypes && !in_array_or(['override', 'implement'], array_column($prototypes, 'kind')),
                'magic'       => false,
                'abstract'    => $refmethod->isAbstract(),
                'final'       => $refmethod->isFinal(),
                'static'      => $refmethod->isStatic(),
                'accessible'  => $refmethod->getAccessible(),
                'prototypes'  => $prototypes,
                'parameters'  => $rmethod['parameters'],
                'return'      => $rmethod['return'],
                'tags'        => $rmethod['tags'],
            ];
        }
        foreach ($magicTags as $tag) {
            // @method のパースに失敗している場合は設定されていない
            if (!isset($tag['name'])) {
                continue;
            }
            $reffunc = $refclass->getMagicMethod($tag['name'], $tag['doccomment'], $tag['parameter']);
            $mmethod = $this->parseFunction($reffunc, $refclass->getNamespaceName(), $refclass->getFqsen());
            $result[$tag['name']] = [
                'category'    => 'method',
                'fqsen'       => $refclass->getFqsen() . '::' . $tag['name'] . '()',
                'namespace'   => $refclass->getNamespaceName(),
                'name'        => $tag['name'],
                'location'    => $refclass->getMagicMethodLocation($tag['name']),
                'description' => $mmethod['description'],
                'virtual'     => false,
                'magic'       => true,
                'abstract'    => false,
                'final'       => false,
                'static'      => $tag['static'],
                'accessible'  => 'public',
                'prototypes'  => [],
                'parameters'  => $mmethod['parameters'],
                'return'      => $mmethod['return'],
                'tags'        => $mmethod['tags'],
            ];
        }

        // used-by 用に配列を詰め替える
        $result2 = [];
        foreach ($result as $k => $v) {
            if (!isset($result2[$k])) {
                $result2[$k] = $v;
            }
            foreach ($v['tags']['used-by'] ?? [] as $used_by) {
                list(, , , $member) = Fqsen::parse($used_by['type']['fqsen']);
                if (isset($result[$member])) {
                    $result2[$member] = $result[$member];
                }
            }
        }

        return $result2;
    }

    private function parseMarkdown($filename)
    {
        $localname = ltrim(str_replace('\\', '/', str_lchop($filename, $this->targetdir)), '/');
        $filehash = sha1($localname);

        $parser = new class extends \cebe\markdown\GithubMarkdown
        {
            private $id = 0;

            protected function renderHeadline($block)
            {
                $this->id++;
                $tag = 'h' . $block['level'];
                /** @noinspection PhpUndefinedFieldInspection */
                return "<$tag id='header-{$this->filehash}-{$this->id}'>" . $this->renderAbsy($block['content']) . "</$tag>\n";
            }
        };
        /** @noinspection PhpUndefinedFieldInspection */
        $parser->filehash = $filehash;
        $parser->enableNewlines = true;
        $html = $parser->parse(file_get_contents($filename));

        $dom = new \DOMDocument('1.0');
        $dom->loadHTML('<html><head><meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>' . $html . '</html>');
        $h1 = [];
        $id = 0;
        foreach ($dom->getElementsByTagName('*') as $node) {
            /** @var \DOMNode $node */
            if (preg_match('#^h(\\d)$#', $node->nodeName, $m)) {
                $id++;
                list($tag, $level) = $m;
                $nexttag = 'h' . ($level + 1);
                ($$tag)[] = ['id' => "header-$filehash-$id", 'content' => $node->textContent, $nexttag => []];
                $$nexttag = &$$tag[count($$tag) - 1][$nexttag];
            }
        }

        $html = preg_replace_callback('#(.*?)([<\{]@.+?[>\}])#', function ($m) use ($filename) {
            $tag = new Tag($m[2], $this->usings, null, null, null);
            $this->fqsens[$filename] = array_merge($this->fqsens[$filename] ?? [], $tag->getDependedFqsens());
            return $m[1] . $tag->getInlineText();
        }, $html);

        $this->markdowns[$localname] = [
            'hash'  => $filehash,
            'index' => $h1,
            'html'  => $html,
        ];
    }

    private function parseDoccomment($doccomment, $namespace, $own)
    {
        $doccomment = trim(preg_replace('#(^/\\*\\*)|(\s+\\*/$)|(^ +\\* ?)#m', '', $doccomment));

        // コードブロックを逃しておく
        $mapping = [];
        preg_match_all('#(`{4,}).+?\1|(`{3,}).+?\2|(`{2,}).+? \3|(`).+?\4#us', $doccomment, $matches, PREG_OFFSET_CAPTURE);
        foreach (array_reverse($matches[0]) as $n => $match) {
            $offset = $match[1];
            $length = strlen($match[0]);
            $tag = "-dummy-" . $n;
            $mapping[$tag] = substr($doccomment, $offset, $length);
            $doccomment = substr_replace($doccomment, $tag, $offset, $length);
        }

        $tags = [];

        $doccomment = preg_replace_callback('#(.*?)([<\{]@.+?[>\}])#', function ($m) use (&$tags, $namespace, $own, $mapping) {
            if (starts_with($m[1], ["    ", "\t"])) {
                return $m[0];
            }
            $tag = new Tag(strtr($m[2], $mapping), $this->usings, $namespace, $own, null);
            $this->fqsens[$own] = array_merge($this->fqsens[$own] ?? [], $tag->getDependedFqsens());
            $tagvalues = $tag->toArray();
            $tags[$tagvalues['tagname']][] = $tagvalues;
            return $m[1] . $tag->getInlineText();
        }, $doccomment);

        $last = null;
        foreach (preg_grep('#^@#', preg_split('#(?=^@)#m', $doccomment)) as $tagstr) {
            $tag = new Tag(strtr($tagstr, $mapping), $this->usings, $namespace, $own, $last);
            $this->fqsens[$own] = array_merge($this->fqsens[$own] ?? [], $tag->getDependedFqsens());
            $tagvalues = $tag->toArray();
            $tags[$tagvalues['tagname']][] = $tagvalues;
            $last = $tagstr;
        }

        $description = preg_match('#^(.*?)(^@|\Z)#ms', $doccomment, $matches) ? $matches[1] : $doccomment;
        $description = strtr($description, $mapping);

        return [
            'description' => $description,
            'tags'        => $tags,
        ];
    }

    private function parseTag($tags)
    {
        /// php レベルではなく、doccomment レベルでの関連はタグとして取れるのでそれらを対象として追加する

        // ただし、通常は targetdir 内はすべて読み込まれているはずなので recursive モードのときだけで十分
        if (!$this->options['recursive']) {
            return;
        }

        // 型を1つだけ持ち得るタグ
        foreach (['see', 'throws'] as $single) {
            foreach ($tags[$single] ?? [] as $tag) {
                if (isset($tag['type']['fqsen'])) {
                    list($cate, $ns, $type) = Fqsen::parse($tag['type']['fqsen']);
                    if ($cate !== 'namespace' && Fqsen::detectType("$ns\\$type")) {
                        $ref = Reflection::instance("$ns\\$type");
                        if (!$ref->isInternal()) {
                            $this->parseFile($ref->getFileName());
                        }
                    }
                }
            }
        }

        // 型を複数持ち得るタグ
        foreach (['var', 'param', 'return'] as $multiple) {
            foreach ($tags[$multiple] ?? [] as $tag) {
                foreach ($tag['type'] as $type) {
                    if (Fqsen::detectType($type['fqsen'])) {
                        $ref = Reflection::instance($type['fqsen']);
                        if (!$ref->isInternal()) {
                            $this->parseFile($ref->getFileName());
                        }
                    }
                }
            }
        }
    }

    private function skip($data, $parentData, $category)
    {
        if ($this->options['contain'] && !fnmatch_or($this->options['contain'], $data['fqsen'], FNM_NOESCAPE)) {
            return true;
        }
        if ($this->options['except'] && fnmatch_or($this->options['except'], $data['fqsen'], FNM_NOESCAPE)) {
            return true;
        }
        if ($data['tags']['ignore'] ?? false) {
            return true;
        }
        if (($data['tags']['ignoreinherit'] ?? false) && ($data['virtual'] ?? false)) {
            return true;
        }
        if (($this->options["no-$category"] ?? false) && ($data['category'] ?? false) === $category) {
            return true;
        }
        foreach (['internal', 'deprecated'] as $tag) {
            if (($this->options["no-$tag-$category"] ?? false) && ($data['tags'][$tag] ?? false)) {
                return true;
            }
            if ((($parentData['tags']["no-$tag"] ?? false) || ($parentData['tags']["no-$tag-$category"] ?? false)) && ($data['tags'][$tag] ?? false)) {
                return true;
            }
        }
        foreach (['virtual', 'magic'] as $type) {
            if (($this->options["no-$type-$category"] ?? false) && ($data[$type] ?? false)) {
                return true;
            }
            if ((($parentData['tags']["no-$type"] ?? false) || ($parentData['tags']["no-$type-$category"] ?? false)) && ($data[$type] ?? false)) {
                return true;
            }
        }
        foreach (['private', 'protected', 'public'] as $accessible) {
            if (($this->options["no-$accessible-$category"] ?? false) && ($data['accessible'] ?? '') === $accessible) {
                return true;
            }
            if ((($parentData['tags']["no-$accessible"] ?? false) || ($parentData['tags']["no-$accessible-$category"] ?? false)) && ($data['accessible'] ?? '') === $accessible) {
                return true;
            }
        }
        return false;
    }
}
