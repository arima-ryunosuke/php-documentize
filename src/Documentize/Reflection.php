<?php

namespace ryunosuke\Documentize;

/**
 * リフレクションを統一的に扱えるようにしたクラス
 *
 * @todo リフレクション周りの汚い処理を押し込めようとしたら本当にクソ汚くなったので要修正
 * @todo いつか個別に継承クラスで作り直す
 */
class Reflection
{
    /** @var \ReflectionFunction|\ReflectionClass|\ReflectionClassConstant|\ReflectionProperty|\ReflectionMethod|\ReflectionParameter */
    private $reflection;

    /** @var self 例えば P <- C で C は P のメソッドを持ち、その実態は P であるが、メソッドのコンテキストで C を得たいこともある */
    private $context;

    public function __construct($reflection, $context = null)
    {
        if (is_string($reflection)) {
            list($category, $ns, $cname, $member) = Fqsen::parse($reflection);
            if ($category === 'classconstant') {
                $reflection = new \ReflectionClassConstant("$ns\\$cname", $member);
            }
            elseif ($category === 'property') {
                $reflection = new \ReflectionProperty("$ns\\$cname", $member);
            }
            elseif ($category === 'method') {
                $reflection = new \ReflectionMethod("$ns\\$cname", $member);
            }
            else {
                $reflection = new \ReflectionClass("$ns\\$cname");
            }
        }
        if (is_array($reflection)) {
            $value = reset($reflection);
            $name = key($reflection);
            $ns = '';
            $parts = explode('\\', $name);
            if (count($parts) > 1) {
                $name = array_pop($parts);
                $ns = implode('\\', $parts);
            }
            $reflection = new \stdClass();
            $reflection->name = $name;
            $reflection->namespace = $ns;
            $reflection->value = $value;
        }
        $this->reflection = $reflection;
        $this->context = $context;
        if (!$context && method_exists($this->reflection, 'getDeclaringClass')) {
            $this->context = new self($this->reflection->getDeclaringClass());
        }
    }

    public function getCategory()
    {
        switch (true) {
            case $this->reflection instanceof \stdClass:
                return 'constant';
            case $this->reflection instanceof \ReflectionFunction:
                return 'function';
            case $this->reflection instanceof \ReflectionClass:
                return $this->isInterface() ? 'interface' : ($this->isTrait() ? 'trait' : 'class');
            case $this->reflection instanceof \ReflectionClassConstant:
                return 'classconstant';
            case $this->reflection instanceof \ReflectionProperty:
                return 'property';
            case $this->reflection instanceof \ReflectionMethod:
                return 'method';
        }
        throw new \DomainException();
    }

    public function getFqsen()
    {
        switch (true) {
            case $this->reflection instanceof \stdClass:
                return ltrim($this->reflection->namespace . '\\' . $this->reflection->name, '\\');
            case $this->reflection instanceof \ReflectionFunction:
                return ($this->reflection->isInternal() ? '\\' : '') . $this->reflection->getName() . '()';
            case $this->reflection instanceof \ReflectionClass:
                return ($this->reflection->isInternal() ? '\\' : '') . $this->reflection->getName();
            case $this->reflection instanceof \ReflectionClassConstant:
                return $this->getNamespaceName() . '::' . $this->getShortName();
            case $this->reflection instanceof \ReflectionProperty:
                return $this->getNamespaceName() . '::$' . $this->getShortName();
            case $this->reflection instanceof \ReflectionMethod:
                return $this->getNamespaceName() . '::' . $this->getShortName() . '()';
        }
        throw new \DomainException();
    }

    public function getNamespaceName()
    {
        switch (true) {
            case $this->reflection instanceof \stdClass:
                return $this->reflection->namespace;
            case $this->reflection instanceof \ReflectionFunction:
            case $this->reflection instanceof \ReflectionClass:
                return $this->reflection->getNamespaceName();
            case $this->reflection instanceof \ReflectionClassConstant:
            case $this->reflection instanceof \ReflectionProperty:
            case $this->reflection instanceof \ReflectionMethod:
                return $this->context->getFqsen();
        }
        throw new \DomainException();
    }

    public function getShortName()
    {
        switch (true) {
            case $this->reflection instanceof \stdClass:
                return $this->reflection->name;
            case $this->reflection instanceof \ReflectionFunction:
            case $this->reflection instanceof \ReflectionClass:
                return $this->reflection->getShortName();
            case $this->reflection instanceof \ReflectionProperty:
            case $this->reflection instanceof \ReflectionMethod:
            case $this->reflection instanceof \ReflectionClassConstant:
            case $this->reflection instanceof \ReflectionParameter:
                return $this->reflection->getName();
        }
        throw new \DomainException();
    }

    public function getFileName()
    {
        switch (true) {
            case $this->reflection instanceof \ReflectionFunction:
            case $this->reflection instanceof \ReflectionClass:
                return $this->reflection->getFileName();
            case $this->reflection instanceof \ReflectionClassConstant:
            case $this->reflection instanceof \ReflectionProperty:
            case $this->reflection instanceof \ReflectionMethod:
                return $this->getDeclaringClass()->getFileName();
        }
        throw new \DomainException();
    }

    public function getLocation()
    {
        switch (true) {
            case $this->reflection instanceof \stdClass:
                // 定数は逆引きできないので順繰りに探さなければならない
                $caches = PhpFile::cache(null);
                $filename = '';
                $lines = [];
                foreach ($caches as $fn => $cache) {
                    if (isset($cache[$this->getNamespaceName()][''][$this->getShortName()])) {
                        $filename = $fn;
                        $lines = $cache[$this->getNamespaceName()][''][$this->getShortName()];
                        break;
                    }
                }
                return [
                    'path'  => $filename,
                    'start' => $lines[0] ?? null,
                    'end'   => $lines[1] ?? null,
                ];
            case $this->reflection instanceof \ReflectionClassConstant:
                $filename = $this->getFileName();
                $dclass = $this->getDeclaringClass();
                $lines = PhpFile::cache($filename)[$dclass->getNamespaceName()][$dclass->getFqsen()][$this->getShortName()] ?? [null, null];
                $start_offset = $this->reflection->getDocComment() ? substr_count($this->reflection->getDocComment(), "\n") + 1 : 0;
                return [
                    'path'  => $filename,
                    'start' => $lines[0] ? $lines[0] - $start_offset : $lines[0],
                    'end'   => $lines[1],
                ];
            case $this->reflection instanceof \ReflectionProperty:
                $filename = $this->getFileName();
                $dclass = $this->getDeclaringClass();
                $lines = PhpFile::cache($filename)[$dclass->getNamespaceName()][$dclass->getFqsen()]['$' . $this->getShortName()] ?? [null, null];
                $start_offset = $this->reflection->getDocComment() ? substr_count($this->reflection->getDocComment(), "\n") + 1 : 0;
                return [
                    'path'  => $filename,
                    'start' => $lines[0] ? $lines[0] - $start_offset : $lines[0],
                    'end'   => $lines[1],
                ];
            case $this->reflection instanceof \ReflectionClass:
            case $this->reflection instanceof \ReflectionFunction:
            case $this->reflection instanceof \ReflectionMethod:
                $start_offset = $this->reflection->getDocComment() ? substr_count($this->reflection->getDocComment(), "\n") + 1 : 0;
                return [
                    'path'  => $this->reflection->getFileName(),
                    'start' => $this->reflection->getStartLine() - $start_offset,
                    'end'   => $this->reflection->getEndLine(),
                ];
        }
        throw new \DomainException();
    }

    public function getDocComment()
    {
        switch (true) {
            case $this->reflection instanceof \ReflectionFunction:
            case $this->reflection instanceof \ReflectionClass:
            case $this->reflection instanceof \ReflectionClassConstant:
            case $this->reflection instanceof \ReflectionProperty:
            case $this->reflection instanceof \ReflectionMethod:
                return $this->reflection->getDocComment();
        }
        throw new \DomainException();
    }

    public function getLastModified()
    {
        switch (true) {
            case $this->reflection instanceof \ReflectionFunction:
                $fn = $this->reflection->getFileName();
                return file_exists($fn) ? filemtime($fn) : null;
            case $this->reflection instanceof \ReflectionClass:
                return max(array_map(function (\ReflectionClass $rc) {
                        $fn = $rc->getFileName();
                        return file_exists($fn) ? filemtime($fn) : null;
                    }, array_merge(
                            [$this->reflection],
                            array_map(function ($parent) { return new \ReflectionClass($parent); }, class_parents($this->reflection->getName())),
                            $this->reflection->getInterfaces(),
                            $this->reflection->getTraits()
                        )
                    )
                );
        }
        throw new \DomainException();
    }

    /** @return $this */
    public function getDeclaringClass()
    {
        switch (true) {
            case $this->reflection instanceof \ReflectionClassConstant:
                return new self($this->reflection->getDeclaringClass());
            case $this->reflection instanceof \ReflectionProperty:
                $filename = $this->context->getFileName();
                if (isset(PhpFile::cache($filename)[$this->context->getNamespaceName()][$this->context->getFqsen()]['$' . $this->getShortName()])) {
                    return $this->context;
                }
                $tmem = $this->context->getTraitProperties();
                if (isset($tmem[$this->getShortName()])) {
                    return reset($tmem[$this->getShortName()])->context;
                }
                return new self($this->reflection->getDeclaringClass());
            case $this->reflection instanceof \ReflectionMethod:
                $filename = $this->context->getFileName();
                if (isset(PhpFile::cache($filename)[$this->context->getNamespaceName()][$this->context->getFqsen()][$this->getShortName() . '()'])) {
                    return $this->context;
                }
                $tmem = $this->context->getTraitMethods();
                if (isset($tmem[$this->getShortName()])) {
                    return $tmem[$this->getShortName()]->context;
                }
                return new self($this->reflection->getDeclaringClass());
        }
        throw new \DomainException();
    }

    public function getParents()
    {
        return array_values(array_map(function ($n) {
            return (new \ReflectionClass($n))->isInternal() ? "\\$n" : $n;
        }, class_parents($this->getFqsen())));
    }

    public function getImplements()
    {
        return array_values(array_map(function ($n) {
            return (new \ReflectionClass($n))->isInternal() ? "\\$n" : $n;
        }, class_implements($this->getFqsen())));
    }

    public function getUses()
    {
        return array_values(array_map(function ($n) {
            return (new \ReflectionClass($n))->isInternal() ? "\\$n" : $n;
        }, class_uses($this->getFqsen())));
    }

    public function isFinal()
    {
        return $this->reflection->isFinal();
    }

    public function isAbstract()
    {
        return $this->reflection->isAbstract();
    }

    public function isIterateable()
    {
        return $this->reflection->isIterateable();
    }

    public function isInterface()
    {
        return $this->reflection->isInterface();
    }

    public function isTrait()
    {
        return $this->reflection->isTrait();
    }

    public function isStatic()
    {
        return $this->reflection->isStatic();
    }

    public function isPrivate()
    {
        return $this->reflection->isPrivate();
    }

    public function isProtected()
    {
        return $this->reflection->isProtected();
    }

    public function isPublic()
    {
        return $this->reflection->isPublic();
    }

    public function getAccessible()
    {
        return $this->isPrivate() ? 'private' : ($this->isProtected() ? 'protected' : 'public');
    }

    /** @return $this[][] */
    public function getTraitProperties()
    {
        $tproperties = [];
        foreach ($this->reflection->getTraits() as $trait) {
            foreach ($trait->getProperties() as $tproperty) {
                $tproperties[$tproperty->getName()][] = new self($tproperty, new self($trait));
            }
        }
        return $tproperties;
    }

    /** @return $this[] */
    public function getTraitMethods()
    {
        $tmethods = array_map(function ($v) { return new self(new \ReflectionMethod($v)); }, $this->reflection->getTraitAliases());

        foreach ($this->reflection->getTraits() as $trait) {
            foreach ($trait->getMethods() as $tmethod) {
                $tmethods[$tmethod->getName()] = new self($tmethod, new self($trait));
            }
        }
        return $tmethods;
    }

    /** @return $this[] */
    public function getConstants()
    {
        $result = [];
        foreach ($this->reflection->getReflectionConstants() as $constant) {
            $result[$constant->getName()] = new self($constant, $this);
        }
        return $result;
    }

    /** @return $this[] */
    public function getProperties()
    {
        $result = [];
        foreach ($this->reflection->getProperties() as $property) {
            $result[$property->getName()] = new self($property, $this);
        }
        return $result;
    }

    /** @return $this[] */
    public function getMethods()
    {
        $result = [];
        foreach ($this->reflection->getMethods() as $method) {
            $result[$method->getName()] = new self($method, $this);
        }
        return $result;
    }

    private function getMagicLocation($pattern)
    {
        $doccomment = $this->getDocComment();
        $lines = preg_split('#\\R#u', $doccomment);
        $line = 0;
        foreach ($lines as $n => $row) {
            if (preg_match($pattern, $row)) {
                $line = $n;
                break;
            }
        }
        // $line == 0 は考慮しない（無いならないで構わない）
        // マジック系はオマケのようなものだし、@magic の記述場所へリンクできたところで嬉しくもなんともないはず（そこに実装がないんだから）
        $offset = $this->reflection->getStartLine() - count($lines);
        return [
            'path'  => $this->getFileName(),
            'start' => $offset + $line,
            'end'   => $offset + $line,
        ];
    }

    public function getMagicPropertyLocation($name)
    {
        return $this->getMagicLocation("#@property.+?\\$" . $name . "[^0-9_a-zA-Z]?#");
    }

    public function getMagicMethodLocation($name)
    {
        return $this->getMagicLocation("#@method.+?" . $name . "[^0-9_a-zA-Z]?#");
    }

    /**
     * @param string $name
     * @param string $doccomment
     * @param string $parameter
     * @return $this
     */
    public function getMagicMethod($name, $doccomment, $parameter)
    {
        static $count = 0;
        $prefix = '_' . str_replace('\\', '_', $this->getFqsen()) . '___magicmethod_' . $count++;
        $funcname = "{$prefix}{$name}";
        PhpFile::evaluate($doccomment . "function $funcname($parameter){}");
        return new self(new \ReflectionFunction($funcname));
    }

    /** @return $this */
    public function getProtoType()
    {
        switch (true) {
            // クラスは親クラスを返す実装とする（インターフェースは…？）
            case $this->reflection instanceof \ReflectionClass:
                $result = $this->reflection->getParentClass();
                if (!$result) {
                    return null;
                }
                return new self($result);
            // メソッドのプロトタイプが最上位を返すので定数・プロパティもそれに合わせる
            case $this->reflection instanceof \ReflectionClassConstant:
                $class = $this->reflection->getDeclaringClass();
                $result = null;
                while ($class = $class->getParentClass()) {
                    if ($class->hasConstant($this->getShortName())) {
                        $constant = $class->getReflectionConstant($this->getShortName());
                        if (!$constant->isPrivate()) {
                            $result = $constant;
                        }
                    }
                }
                if (!$result) {
                    return null;
                }
                return new self($result);
            // 上記の通り。ただし、プロパティはトレイトも見なければならない
            case $this->reflection instanceof \ReflectionProperty:
                $class = $this->reflection->getDeclaringClass();
                $result = null;
                while ($class = $class->getParentClass()) {
                    if ($class->hasProperty($this->getShortName())) {
                        $property = $class->getProperty($this->getShortName());
                        if (!$property->isPrivate()) {
                            $result = $property;
                        }
                    }
                }
                if (!$result) {
                    foreach ($this->reflection->getDeclaringClass()->getTraits() as $trait) {
                        if ($trait->hasProperty($this->getShortName())) {
                            $result = $trait->getProperty($this->getShortName());
                        }
                    }
                }
                if (!$result) {
                    return null;
                }
                return new self($result);
            // メソッドは getPrototype が用意されているが、継承階層の一番を上を返すのみでトレイトはサポートされていない
            case $this->reflection instanceof \ReflectionMethod:
                try {
                    // コンストラクタの場合は getPrototype が必ず例外を投げる？ようなので自前で検出
                    if ($this->reflection->isConstructor()) {
                        $class = $this->reflection->getDeclaringClass();
                        while ($class = $class->getParentClass()) {
                            if ($class->hasMethod($this->getShortName())) {
                                $method = $class->getMethod($this->getShortName());
                                if (!$method->isPrivate()) {
                                    return new self($method);
                                }
                            }
                        }
                    }
                    return new self($this->reflection->getPrototype());
                }
                catch (\Exception $ex) {
                    foreach ($this->reflection->getDeclaringClass()->getTraits() as $trait) {
                        if ($trait->hasMethod($this->getShortName())) {
                            return new self($trait->getMethod($this->getShortName()));
                        }
                    }
                    return null;
                }
        }
        throw new \DomainException();
    }

    public function getProtoTypes()
    {
        switch (true) {
            case $this->reflection instanceof \ReflectionClassConstant:
                $prototype = $this->getProtoType();
                $prototypes = [];
                // プロトタイプがあるなら override
                if ($prototype) {
                    $prototypes[] = [
                        'kind'  => 'override',
                        'fqsen' => $prototype->getFqsen(),
                    ];
                }
                // 自身名と定義名が異なるなら inherit
                if ($this->context->getFqsen() !== $this->getDeclaringClass()->getFqsen()) {
                    $prototypes[] = [
                        'kind'  => 'inherit',
                        'fqsen' => $this->getDeclaringClass()->getFqsen() . '::' . $this->getShortName(),
                    ];
                }
                return $prototypes;
            case $this->reflection instanceof \ReflectionProperty:
                $thisname = '$' . $this->getShortName();
                $prototype = $this->getProtoType();
                $tproperties = $this->context->getTraitProperties();
                $properties = PhpFile::cache($this->context->getFileName())[$this->context->getNamespaceName()][$this->context->getFqsen()] ?? [];
                $prototypes = [];
                $overidden = false;
                // 自身でも定義していてかつプロトタイプがあるなら override
                if (isset($properties[$thisname]) && $prototype) {
                    $overidden = true;
                    $prototypes[] = [
                        'kind'  => 'override',
                        'fqsen' => $prototype->getFqsen(),
                    ];
                }
                // 自身にもトレイトにもなく、定義クラスが異なるなら inherit
                if (!isset($properties[$thisname]) && !isset($tproperties[$this->getShortName()]) && $this->context->getFqsen() !== $this->getDeclaringClass()->getFqsen()) {
                    $prototypes[] = [
                        'kind'  => 'inherit',
                        'fqsen' => $this->getDeclaringClass()->getFqsen() . '::' . $thisname,
                    ];
                }
                // override ではなく取得しておいたトレイトのプロパティリストにあるなら instead
                if (!$overidden) {
                    foreach ($tproperties[$this->getShortName()] ?? [] as $tproperty) {
                        $prototypes[] = [
                            'kind'  => 'instead',
                            'fqsen' => $tproperty->getFqsen(),
                        ];
                    }
                }
                return $prototypes;
            case $this->reflection instanceof \ReflectionMethod:
                $thisname = $this->getShortName() . '()';
                $prototype = $this->getProtoType();
                $tmethods = $this->context->getTraitMethods();
                $methods = PhpFile::cache($this->context->getFileName())[$this->context->getNamespaceName()][$this->context->getFqsen()] ?? [];
                $prototypes = [];
                $overidden = false;
                // 自身でも定義していてかつプロトタイプがあり、それがクラスなら override
                if (isset($methods[$thisname]) && $prototype && !$prototype->getDeclaringClass()->isInterface()) {
                    $overidden = true;
                    $prototypes[] = [
                        'kind'  => 'override',
                        'fqsen' => $prototype->getFqsen(),
                    ];
                }
                // 自身でも定義していてかつプロトタイプがあり、それがインターフェースなら implement
                if (isset($methods[$thisname]) && $prototype && $prototype->getDeclaringClass()->isInterface()) {
                    $prototypes[] = [
                        'kind'  => 'implement',
                        'fqsen' => $prototype->getFqsen(),
                    ];
                }
                // 自身にもトレイトにもなく、定義クラスが異なるなら inherit
                if (!isset($methods[$thisname]) && !isset($tmethods[$this->getShortName()]) && $this->context->getFqsen() !== $this->getDeclaringClass()->getFqsen()) {
                    $prototypes[] = [
                        'kind'  => 'inherit',
                        'fqsen' => $this->getDeclaringClass()->getFqsen() . '::' . $thisname,
                    ];
                }
                // override ではなく取得しておいたトレイトのメソッドリストにあるなら instead
                if (!$overidden && isset($tmethods[$this->getShortName()])) {
                    $prototypes[] = [
                        'kind'  => 'instead',
                        'fqsen' => $tmethods[$this->getShortName()]->getFqsen(),
                    ];
                }
                return $prototypes;
        }
        throw new \DomainException();
    }

    /** @return $this[] */
    public function getParameters()
    {
        $result = [];
        foreach ($this->reflection->getParameters() as $parameter) {
            $result[$parameter->getName()] = new self($parameter, $this);
        }
        return $result;
    }

    /** @return \ReflectionType */
    public function getType()
    {
        switch (true) {
            case $this->reflection instanceof \ReflectionFunction:
            case $this->reflection instanceof \ReflectionMethod:
                return $this->reflection->getReturnType();
            case $this->reflection instanceof \ReflectionParameter:
                return $this->reflection->getType();
        }
        throw new \DomainException();
    }

    public function getDeclaration()
    {
        $declaration = '';
        $declaration .= $this->reflection->isVariadic() ? '...' : '';
        $declaration .= $this->reflection->isPassedByReference() ? '&' : '';
        $declaration .= '$' . $this->reflection->getName();
        if ($this->reflection->isDefaultValueAvailable()) {
            if ($this->reflection->isDefaultValueConstant()) {
                $declaration .= ' = ' . $this->reflection->getDefaultValueConstantName();
            }
            else {
                $declaration .= ' = ' . var_export2($this->reflection->getDefaultValue(), true);
            }
        }
        return $declaration;
    }

    public function getValue()
    {
        switch (true) {
            case $this->reflection instanceof \stdClass:
                return $this->reflection->value;
            case $this->reflection instanceof \ReflectionClassConstant:
                return $this->reflection->getValue();
            case $this->reflection instanceof \ReflectionProperty:
                // この静的変数はキャッシュも兼ねるが、一番の目的は「notice が大量に出ないように」すること
                static $values = [];
                $key = $this->getFqsen();
                if (!array_key_exists($key, $values)) {
                    // 以下の処理はオートローダが起動することがあり、クラスが読み込めないなら fatal になるし、勝手定義の場合は undefined Error になる
                    // 捕捉できないものもあるが、気休め程度に Throwable をキャッチしてログる
                    set_error_handler(function ($errno, $errstr) { throw new \ErrorException($errstr, 0, $errno); });
                    try {
                        // static は getDefaultProperties で取れない（http://php.net/manual/ja/reflectionclass.getdefaultproperties.php）
                        if ($this->isStatic()) {
                            $this->reflection->setAccessible(true);
                            $values[$key] = $this->reflection->getValue();
                        }
                        else {
                            $values[$key] = $this->context->reflection->getDefaultProperties()[$this->getShortName()];
                        }
                        restore_error_handler();
                    }
                    catch (\Throwable $t) {
                        restore_error_handler();
                        trigger_error($t->getMessage() . " in " . $this->getFileName());
                        $values[$key] = null;
                    }
                }
                return $values[$key];
        }
        throw new \DomainException();
    }
}
