<?php

namespace ryunosuke\Documentize;

use ryunosuke\Documentize\Utils\Adhoc;
use ryunosuke\Documentize\Utils\Arrays;
use ryunosuke\Documentize\Utils\FileSystem;
use ryunosuke\Documentize\Utils\Vars;
use Symfony\Component\Process\Process;

class Document
{
    /** @var array 動作オプション */
    private $options = [];

    /** @var array 名前空間ごとの use 節マッピング */
    private $usings = [];

    /** @var string 掻き集めてるディレクトリ */
    private $targetdir, $targethash;

    public static function gatherIsolative($options, &$logs = null)
    {
        $outfile = tempnam(sys_get_temp_dir(), 'rdz');
        $process = new Process([
            PHP_BINARY,
            '-r',
            'require_once ' . var_export(__DIR__ . '/../vendor/autoload.php', true) . ';
$document = new \\ryunosuke\\Documentize\\Document(unserialize(stream_get_contents(STDIN)));
$gathertime = microtime(true);
$readcount = count(get_included_files());
$namespaces = $document->gather($logs);
file_put_contents(' . var_export($outfile, true) . ', serialize([
    "namespaces" => $namespaces,
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
        class_exists(Utils\Adhoc::class, true);
        class_exists(\ryunosuke\Documentize\Utils\Arrays::class, true);
        class_exists(\ryunosuke\Documentize\Utils\Classobj::class, true);
        class_exists(\ryunosuke\Documentize\Utils\FileSystem::class, true);
        class_exists(\ryunosuke\Documentize\Utils\Funchand::class, true);
        class_exists(\ryunosuke\Documentize\Utils\Math::class, true);
        class_exists(\ryunosuke\Documentize\Utils\Strings::class, true);
        class_exists(\ryunosuke\Documentize\Utils\Syntax::class, true);
        class_exists(\ryunosuke\Documentize\Utils\Utility::class, true);
        class_exists(\ryunosuke\Documentize\Utils\Vars::class, true);

        $this->options = array_replace([
            'target'                 => null,
            'autoloader'             => null,
            'recursive'              => false,
            'include'                => [],
            'exclude'                => [],
            'contain'                => [],
            'except'                 => [],
            'cachedir'               => null,
            'no-internal-constant'   => false,
            'no-internal-function'   => false,
            'no-internal-type'       => false,
            'no-internal-property'   => false,
            'no-internal-method'     => false,
            'no-deprecated-constant' => false,
            'no-deprecated-function' => false,
            'no-deprecated-type'     => false,
            'no-deprecated-property' => false,
            'no-deprecated-method'   => false,
            'no-magic-property'      => false,
            'no-magic-method'        => false,
            'no-virtual-constant'    => false,
            'no-virtual-property'    => false,
            'no-virtual-method'      => false,
            'no-private-constant'    => false,
            'no-private-property'    => false,
            'no-private-method'      => false,
            'no-protected-constant'  => false,
            'no-protected-property'  => false,
            'no-protected-method'    => false,
            'no-public-constant'     => false,
            'no-public-property'     => false,
            'no-public-method'       => false,
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
     * @todo いろいろ拡張していたらいつのまにか参照地獄になっていたので綺麗に書き直す
     *
     * @param array $logs 掻き集めてる最中のログが格納される
     * @return array 名前空間単位のメタ情報
     */
    public function gather(&$logs = [])
    {
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
            foreach (FileSystem::file_list($this->options['target']) as $file) {
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
            if (!isset($target['tags']['inheritdoc'][0])) {
                return;
            }
            $doctag = $target['tags']['inheritdoc'][0];
            if ($doctag['type']) {
                $tfqsen = $doctag['type']['fqsen'];
            }
            else {
                $ref = new Reflection($target['fqsen']);
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
            list(, $ns, $cname, $member) = Fqsen::parse(rtrim($tfqsen, '()'));
            $member = rtrim(ltrim($member, '$'), '()');
            $OK = false;
            foreach (['interfaces', 'traits', 'classes'] as $type) {
                if ($mtype == 'type') {
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
                $inheritdoc($parent, $mtype);

                // タグは要素を問わずすべて継承
                $target['tags'] = $parent['tags'];

                // インラインは置換ではなく埋め込み。インラインでないなら完全置換
                if ($doctag['inline']) {
                    $target['description'] = str_replace('HereIsInheritdoc', trim($parent['description']), $target['description']);
                }
                else {
                    // ただし、子供自身の記述を活かしたい場合もあるので空の場合のみ
                    if (!trim($target['description'])) {
                        $target['description'] = $parent['description'];
                    }
                }

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
                    // メソッドは引数と返り値を継承
                    $target['parameters'] = $parent['parameters'];
                    $target['return'] = $parent['return'];
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
            foreach (['interfaces', 'traits', 'classes'] as $type) {
                foreach (['constants', 'properties', 'methods'] as $mtype) {
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
                $member = rtrim(ltrim($member, '$'), '()');
                foreach (['constant' => 'constants', 'property' => 'properties', 'method' => 'methods'] as $cate => $key) {
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

            foreach (['constants', 'properties', 'methods'] as $mtype) {
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
                        'category'    => $type['category'],
                        'description' => $type['description'],
                    ];
                });
            }
        };
        $result = [];
        ksort($namespaces);
        foreach ($namespaces as $namespace => $data) {
            if ($this->skip($data, null)) {
                continue;
            }
            foreach (['constants' => 'constant', 'functions' => 'function'] as $key => $name) {
                foreach ($data[$key] as $n => $e) {
                    if ($this->skip($e, $name)) {
                        unset($data[$key][$n]);
                    }
                }
            }
            foreach (['interfaces' => 'type', 'traits' => 'type', 'classes' => 'type'] as $key => $name) {
                foreach ($data[$key] as $n => $e) {
                    if ($this->skip($e, $name)) {
                        unset($data[$key][$n]);
                        continue;
                    }
                    foreach (['constants' => 'constant', 'properties' => 'property', 'methods' => 'method'] as $key2 => $name2) {
                        foreach ($e[$key2] as $n2 => $e2) {
                            if ($this->skip($e2, $name2)) {
                                unset($data[$key][$n][$key2][$n2]);
                            }
                        }
                    }
                }
            }

            // 環境によって関数の定義順がバラけるようなので functions だけは定義順でソート
            uasort($data['functions'], function ($a, $b) { return $a['location']['start'] - $b['location']['start']; });

            foreach (['interfaces', 'traits', 'classes'] as $type) {
                array_walk($data[$type], $marshal);
            }

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

        restore_error_handler();

        return $result;
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
        FileSystem::file_set_contents($cachename, serialize($usings));
        return $usings;
    }

    private function defaultNS($namespace)
    {
        $parts = explode('\\', $namespace);
        $name = array_pop($parts);
        $ns = implode('\\', $parts);
        return [
            'category'   => 'namespace',
            'fqsen'      => "$namespace\\",
            'namespace'  => $ns,
            'name'       => $name,
            'namespaces' => [],
            'constants'  => [],
            'functions'  => [],
            'interfaces' => [],
            'traits'     => [],
            'classes'    => [],
        ];
    }

    private function parse(&$namespaces, &$hierarchies, $constants, $functions, $interfaces, $traits, $classes)
    {
        $result = 0;
        foreach ($constants as $name => $value) {
            $ref = new Reflection([$name => $value]);

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
            $ref = new Reflection(new \ReflectionFunction($name));
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
        $categories = [
            'interface' => 'interfaces',
            'trait'     => 'traits',
            'class'     => 'classes',
        ];
        foreach ([$interfaces, $traits, $classes] as $types) {
            foreach ($types as $name) {
                $ref = new Reflection(new \ReflectionClass($name));
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

                foreach ($this->cache($ref->getFqsen() . '.constants', $lasttime, function () use ($ref) {
                    return $this->parseClassConstant($ref);
                }) as $n => $e) {
                    $this->parseTag($e['tags']);
                    $data['constants'][$n] = $e;
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

                $category = $categories[$data['category']];
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

        if (!Adhoc::fnmatchs($this->options['include'], $filename, FNM_NOESCAPE)) {
            return false;
        }
        if (Adhoc::fnmatchs($this->options['exclude'], $filename, FNM_NOESCAPE)) {
            return false;
        }

        require_once $filename;
        $readfiles[$filename] = true;

        $usings = array_map(function ($v) { return $v['@using'] ?? []; }, $this->cache("$filename.parsed", filemtime($filename), function () use ($filename) {
            return PhpFile::cache($filename);
        }));

        foreach ($usings as $ns => $using) {
            if (!isset($this->usings[$ns])) {
                $this->usings[$ns] = [];
            }
            $this->usings[$ns] += $using;
        }

        if ($this->options['recursive']) {
            array_walk_recursive($usings, function ($class) {
                if (Fqsen::detectType($class)) {
                    $ref = new \ReflectionClass($class);
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
        return [
            'description' => '', // 取りようがない
            'value'       => Vars::var_export2($refconst->getValue(), true),
            'accessible'  => 'public', // 取りようがない
            'types'       => (new Fqsen(gettype($refconst->getValue())))->resolve($this->usings, $namespace, $own),
            'tags'        => [], // 取りようがない
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
            /** @var \ReflectionType $type */
            $stype = (string) $type;
            if (!$stype) {
                return $types;
            }
            $fqsen = new Fqsen(($type->isBuiltin() ? '' : '\\') . $stype);
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
            'category'    => $refclass->getCategory(),
            'fqsen'       => $refclass->getFqsen(),
            'namespace'   => $refclass->getNamespaceName(),
            'name'        => $refclass->getShortName(),
            'location'    => $refclass->getLocation(),
            'description' => $classdocs['description'],
            'final'       => $refclass->isFinal(),
            'abstract'    => $refclass->isAbstract(),
            'cloneable'   => false, // $refclass->isCloneable(), # php has bug called __destruct
            'iterateable' => $refclass->isIterateable(),
            'hierarchy'   => [],
            'parents'     => $refclass->getParents(),
            'implements'  => $refclass->getImplements(),
            'uses'        => $refclass->getUses(),
            'constants'   => [],
            'properties'  => [],
            'methods'     => [],
            'tags'        => $classdocs['tags'],
        ];

        return $result;
    }

    private function parseClassConstant(Reflection $refclass)
    {
        $result = [];
        foreach ($refclass->getConstants() as $refconst) {
            $constdocs = $this->parseDoccomment($refconst->getDocComment(), $refclass->getNamespaceName(), $refclass->getFqsen());
            $types = $constdocs['tags']['var'][0]['type'] ?? (new Fqsen(gettype($refconst->getValue())))->resolve($this->usings, $refclass->getNamespaceName(), $refclass->getFqsen());
            $prototypes = $refconst->getProtoTypes();
            $result[$refconst->getShortName()] = [
                'category'    => $refconst->getCategory(),
                'fqsen'       => $refconst->getFqsen(),
                'namespace'   => $refconst->getNamespaceName(),
                'name'        => $refconst->getShortName(),
                'location'    => $refconst->getLocation(),
                'description' => $constdocs['description'] ?: $constdocs['tags']['var'][0]['description'] ?? '',
                'value'       => Vars::var_export2($refconst->getValue(), true),
                'virtual'     => $prototypes && !Arrays::in_array_or(['override'], array_column($prototypes, 'kind')),
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
        $result = [];
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
        foreach ($refclass->getProperties() as $refproperty) {
            $propdocs = $this->parseDoccomment($refproperty->getDocComment(), $refclass->getNamespaceName(), $refclass->getFqsen());
            $types = $propdocs['tags']['var'][0]['type'] ?? (new Fqsen(gettype($refproperty->getValue())))->resolve($this->usings, $refclass->getNamespaceName(), $refclass->getFqsen());
            $prototypes = $refproperty->getProtoTypes();
            $result[$refproperty->getShortName()] = [
                'category'    => $refproperty->getCategory(),
                'fqsen'       => $refproperty->getFqsen(),
                'namespace'   => $refproperty->getNamespaceName(),
                'name'        => $refproperty->getShortName(),
                'location'    => $refproperty->getLocation(),
                'description' => $propdocs['description'] ?: $propdocs['tags']['var'][0]['description'] ?? '',
                'value'       => Vars::var_export2($refproperty->getValue(), true),
                'virtual'     => $prototypes && !Arrays::in_array_or(['override'], array_column($prototypes, 'kind')),
                'magic'       => false,
                'static'      => $refproperty->isStatic(),
                'accessible'  => $refproperty->getAccessible(),
                'prototypes'  => $prototypes,
                'types'       => $types,
                'tags'        => $propdocs['tags'],
            ];
        }
        return $result;
    }

    private function parseMethod(Reflection $refclass, $magicTags)
    {
        $result = [];
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
        foreach ($refclass->getMethods() as $refmethod) {
            $rmethod = $this->parseFunction($refmethod, $refclass->getNamespaceName(), $refclass->getFqsen());
            $prototypes = $refmethod->getProtoTypes();
            $result[$refmethod->getShortName()] = [
                'category'    => $refmethod->getCategory(),
                'fqsen'       => $refmethod->getFqsen(),
                'namespace'   => $refmethod->getNamespaceName(),
                'name'        => $refmethod->getShortName(),
                'location'    => $refmethod->getLocation(),
                'description' => $rmethod['description'],
                'virtual'     => $prototypes && !Arrays::in_array_or(['override', 'implement'], array_column($prototypes, 'kind')),
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
        return $result;
    }

    private function parseDoccomment($doccomment, $namespace, $own)
    {
        $doccomment = trim(preg_replace('#(^/\\*\\*)|(\s+\\*/$)|(^ +\\* ?)#m', '', $doccomment));

        $tags = [];
        $description = '';

        if (preg_match('#^(.*?)(^@|\Z)#ms', $doccomment, $matches)) {
            $description = $matches[1];
        }

        $description = preg_replace_callback('#\{@.+\}#', function ($m) use (&$tags, $namespace, $own) {
            $tag = new Tag($m[0], $this->usings, $namespace, $own);
            $tagvalues = $tag->toArray();
            $tags[$tagvalues['tagname']][] = $tagvalues;
            return $tag->getInlineText();
        }, $description);

        foreach (preg_grep('#^@#', preg_split('#(?=^@)#m', $doccomment)) as $tag) {
            $tag = new Tag($tag, $this->usings, $namespace, $own);
            $tagvalues = $tag->toArray();
            $tags[$tagvalues['tagname']][] = $tagvalues;
        }

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
                        $ref = new \ReflectionClass("$ns\\$type");
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
                        $ref = new \ReflectionClass($type['fqsen']);
                        if (!$ref->isInternal()) {
                            $this->parseFile($ref->getFileName());
                        }
                    }
                }
            }
        }
    }

    private function skip($data, $context)
    {
        if (!Adhoc::fnmatchs($this->options['contain'], $data['fqsen'], FNM_NOESCAPE)) {
            return true;
        }
        if (Adhoc::fnmatchs($this->options['except'], $data['fqsen'], FNM_NOESCAPE)) {
            return true;
        }
        if (($this->options["no-internal-$context"] ?? false) && ($data['tags']['internal'] ?? false)) {
            return true;
        }
        if (($this->options["no-deprecated-$context"] ?? false) && ($data['tags']['deprecated'] ?? false)) {
            return true;
        }
        if (($this->options["no-virtual-$context"] ?? false) && ($data['virtual'] ?? false)) {
            return true;
        }
        if (($this->options["no-magic-$context"] ?? false) && ($data['magic'] ?? false)) {
            return true;
        }
        if (($this->options["no-private-$context"] ?? false) && ($data['accessible'] ?? '') === 'private') {
            return true;
        }
        if (($this->options["no-protected-$context"] ?? false) && ($data['accessible'] ?? '') === 'protected') {
            return true;
        }
        if (($this->options["no-public-$context"] ?? false) && ($data['accessible'] ?? '') === 'public') {
            return true;
        }
        return false;
    }
}
