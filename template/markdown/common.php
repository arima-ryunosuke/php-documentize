<?php

class Renderer
{
    private array $config;
    private array $existedFqsens;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function preprocess(array $namespaces): array
    {
        $this->existedFqsens = [];

        foreach ($namespaces as $namespace) {
            array_walk_recursive($namespace, function ($value, $key) use ($namespace) {
                if ($key === 'id') {
                    $this->existedFqsens[$value] = match ($this->config['mode']) {
                        'flat' => implode('-', array_slice(array_slice(explode('\\', explode('::', $value)[0]), 0, -1), 0, 3)),
                        'nest' => strtr(rtrim($namespace['fqsen'], '\\'), ['\\' => '-']) ?: 'global'
                    };
                }
            });
        }
        array_walk_recursive($namespaces, function (&$value, $key) {
            if ($key === 'description' || $key === 'summary') {
                $any = "\\s+([^>]*?)";
                $some = fn($attr) => "$attr='([^']*?)'";
                $body = "(?<body>[^<]*?)";
                $value = preg_replace_callback_array([
                    "#<(tag_inheritdoc){$any}>{$body}</\\1>#um"                           => fn($m) => $m['body'],
                    "#<(tag_link){$any}{$some('data-type-fqsen')}{$any}>{$body}</\\1>#um" => fn($m) => $this->inlineLink($m[3], $m['body']),
                    "#<(tag_link){$any}{$some('data-type')}{$any}>{$body}</\\1>#um"       => fn($m) => $this->inlineLink($m[3], $m['body']),
                    "#<(tag_source){$any}{$some('data-fqsen')}{$any}>{$body}</\\1>#um"    => fn($m) => $this->inlineLink($m[3], $m['body']),
                ], trim($value ?? ''));
            }
        });

        if ($this->config['mode'] === 'flat') {
            $result = [];
            $flatten = function ($namespaces) use (&$flatten, &$result) {
                foreach ($namespaces as $namespace) {
                    $subspace = [];
                    if (count(explode('\\', trim($namespace['fqsen'], '\\'))) < 3) {
                        $subspace = $namespace['namespaces'];
                        $namespace['namespaces'] = [];
                    }
                    $result[$namespace['fqsen']] = $namespace;
                    $flatten($subspace);
                }
            };
            $flatten($namespaces);
            return $result;
        }
        return $namespaces;
    }

    public function render(array $namespaces): \Generator
    {
        if ($this->config['mode'] === 'flat') {
            yield 'index' => <<<CONTENTS
            <style>{$this->echo(preg_replace('#\\R{2,}#u', "\n", file_get_contents(__DIR__ . '/common.css')))}</style>
            <script>{$this->echo(preg_replace('#\\R{2,}#u', "\n", file_get_contents(__DIR__ . '/common.js')))}</script>
            
            {$this->each($namespaces, fn($namespace) => $this->blockNamespaceIndex($namespace, 2), "\n")}
            
            CONTENTS;
        }

        foreach ($namespaces as $namespace) {
            yield $namespace['fqsen'] => <<<CONTENTS
            <style>{$this->echo(preg_replace('#\\R{2,}#u', "\n", file_get_contents(__DIR__ . '/common.css')))}</style>
            <script>{$this->echo(preg_replace('#\\R{2,}#u', "\n", file_get_contents(__DIR__ . '/common.js')))}</script>
            
            {$this->blockNamespace($namespace)}
            
            CONTENTS;
        }
    }

    protected function blockNamespaceIndex(array $namespace, int $level): string
    {
        $tableOptions = [
            [
                'header'  => 'name',
                'width'   => 30,
                'label'   => fn($fqsen) => '',
                'content' => fn($fqsen) => $this->inlineLink($fqsen['fqsen']),
            ],
            [
                'header'  => 'summary',
                'width'   => 70,
                'label'   => fn($fqsen) => '',
                'content' => fn($fqsen) => $this->inlineSummary($fqsen['summary']),
            ],
        ];

        return <<<INDEX
        {$this->blockHeader($level, "{$this->inlineMark($namespace)}{$this->markdown((rtrim($namespace['fqsen'], '\\') ?: 'global') . "\\")} {$this->inlineSmall($this->inlineSummary($namespace['summary']))}", $namespace['fqsen'] ?: 'global')}
        
        {$this->if(!!$namespace['constants'], <<<C
        {$this->table('constants', $namespace['constants'], $tableOptions)}
        C,)}
        
        {$this->if(!!$namespace['functions'], <<<C
        {$this->table('functions', $namespace['functions'], $tableOptions)}
        C,)}
        
        {$this->if(!!$namespace['classes'], <<<C
        {$this->table('classes', $namespace['classes'], $tableOptions)}
        C,)}
        
        {$this->if(!!$namespace['traits'], <<<C
        {$this->table('traits', $namespace['traits'], $tableOptions)}
        C,)}
        
        {$this->if(!!$namespace['interfaces'], <<<C
        {$this->table('interfaces', $namespace['interfaces'], $tableOptions)}
        C,)}
        
        {$this->if(!!$namespace['namespaces'], <<<C
        {$this->each($namespace['namespaces'], fn($fqsen) => $this->blockNamespaceIndex($fqsen, 3), "\n")}
        C,)}
        
        INDEX;
    }

    protected function blockNamespace(array $namespace): string
    {
        return <<<NAMESPACE
        {$this->blockHeader(2, "{$this->inlineMark($namespace)}{$this->markdown((rtrim($namespace['fqsen'], '\\') ?: 'global') . "\\")} {$this->inlineSmall($this->inlineSummary($namespace['summary']))}", $namespace['fqsen'] ?: 'global')}
        {$this->blockDescription($namespace['description'], false)}
        {$this->if(!!$namespace['constants'], <<<C
        {$this->blockHeader(3, "[G] constants", $namespace['fqsen'] . '-constants')}
        {$this->each($namespace['constants'], fn($fqsen) => $this->blockConstant($fqsen), "\n")}
        C,)}
        {$this->if(!!$namespace['functions'], <<<F
        {$this->blockHeader(3, "[F] functions", $namespace['fqsen'] . '-functions')}
        {$this->each($namespace['functions'], fn($fqsen) => $this->blockFunction($fqsen), "\n")}
        F,)}
        {$this->each($namespace['classes'], fn($fqsen) => $this->blockTypespace($fqsen), "\n")}
        {$this->each($namespace['traits'], fn($fqsen) => $this->blockTypespace($fqsen), "\n")}
        {$this->each($namespace['interfaces'], fn($fqsen) => $this->blockTypespace($fqsen), "\n")}
        {$this->each($namespace['namespaces'], fn($fqsen) => $this->blockNamespace($fqsen), "\n")}
        
        NAMESPACE;
    }

    protected function blockTypespace(array $typespace): string
    {
        return <<<TYPESPACE
        {$this->blockHeader(3, "{$this->inlineAttributes($typespace['attributes'])}{$this->inlineMark($typespace)}{$this->markdown($typespace['name'])} {$this->inlineSmall($this->inlineSummary($typespace['summary']))}", $typespace['fqsen'])}
        {$this->blockAside([$this->inlineBadges($typespace), $this->inlineSource($typespace['location'])])}
        {$this->blockDescription($typespace['description'], false)}
        {$this->blockSee($typespace['tags']['see'] ?? [])}
        {$this->blockHierarchy($typespace['hierarchy'], $typespace['fqsen'])}
        {$this->blockParent($typespace['parents'])}
        {$this->blockImplement($typespace['implements'])}
        {$this->blockUse($typespace['uses'])}
        {$this->each($typespace['classconstants'], fn($fqsen) => $this->blockClassConstant($fqsen), "\n")}
        {$this->each($typespace['properties'], fn($fqsen) => $this->blockProperty($fqsen), "\n")}
        {$this->each($typespace['methods'], fn($fqsen) => $this->blockMethod($fqsen), "\n")}
        TYPESPACE;
    }

    protected function blockConstant(array $fqsen): string
    {
        return <<<CONSTANT
        {$this->blockHeader(4, "{$this->inlineAttributes($fqsen['attributes'])}{$this->inlineMark($fqsen)}{$this->markdown($fqsen['name'])} {$this->inlineSmall($this->inlineSummary($fqsen['summary']))}", $fqsen['fqsen'])}
        {$this->blockAside([$this->inlineBadges($fqsen), $this->inlineSource($fqsen['location'])])}
        {$this->details($fqsen['summary'], <<<DETAILS
        {$this->blockDefinitation("const {$this->concat($this->inlineType($fqsen['types'], true), ' ')}{$fqsen['name']}{$this->concat(' = ', $fqsen['value'])}")}
        {$this->blockDescription($fqsen['description'], true)}
        {$this->blockSee($fqsen['tags']['see'] ?? [])}
        DETAILS,)}
        
        CONSTANT;
    }

    protected function blockFunction(array $fqsen): string
    {
        return <<<FUNCTION
        {$this->blockHeader(4, "{$this->inlineAttributes($fqsen['attributes'])}{$this->inlineMark($fqsen)}{$this->markdown($fqsen['name'])} {$this->inlineSmall($this->inlineSummary($fqsen['summary']))}", $fqsen['fqsen'])}
        {$this->blockAside([$this->inlineBadges($fqsen), $this->inlineSource($fqsen['location'])])}
        {$this->details($fqsen['summary'], <<<DETAILS
        {$this->blockDefinitation("function {$fqsen['name']}{$this->inlineSignature($fqsen['parameters'], true)}{$this->concat(': ', $this->inlineType($fqsen['return']['types'], true))}")}
        {$this->blockDescription($fqsen['description'], true)}
        {$this->blockParameter($fqsen['parameters'])}
        {$this->blockReturn($fqsen['returns'])}
        {$this->blockThrows($fqsen['tags']['throws'] ?? [])}
        {$this->blockSee($fqsen['tags']['see'] ?? [])}
        DETAILS,)}
        
        FUNCTION;
    }

    protected function blockClassConstant(array $fqsen): string
    {
        return <<<CLASSCONSTANT
        {$this->blockHeader(4, "{$this->inlineAttributes($fqsen['attributes'])}{$this->inlineMark($fqsen)}{$this->markdown($fqsen['name'])} {$this->inlineSmall($this->inlineSummary($fqsen['summary']))}", $fqsen['fqsen'])}
        {$this->blockAside([$this->inlineBadges($fqsen), $this->inlineSource($fqsen['location'])])}
        {$this->details($fqsen['summary'], <<<DETAILS
        {$this->blockDefinitation("{$this->inlineModifier($fqsen)} const {$this->concat($this->inlineType($fqsen['types'], true), ' ')}{$fqsen['name']}{$this->concat(' = ', $fqsen['value'])}")}
        {$this->blockDescription($fqsen['description'], true)}
        {$this->blockPrototype($fqsen['prototypes'])}
        {$this->blockSee($fqsen['tags']['see'] ?? [])}
        DETAILS,)}
        
        CLASSCONSTANT;
    }

    protected function blockProperty(array $fqsen): string
    {
        return <<<PROPERTY
        {$this->blockHeader(4, "{$this->inlineAttributes($fqsen['attributes'])}{$this->inlineMark($fqsen)}\${$this->markdown($fqsen['name'])} {$this->inlineSmall($this->inlineSummary($fqsen['summary']))}", $fqsen['fqsen'])}
        {$this->blockAside([$this->inlineBadges($fqsen), $this->inlineSource($fqsen['location'])])}
        {$this->details($fqsen['summary'], <<<DETAILS
        {$this->blockDefinitation("{$this->inlineModifier($fqsen)} {$this->concat($this->inlineType($fqsen['types'], true), ' ')}\${$fqsen['name']}{$this->concat(' = ', $fqsen['hasValue'] ? $fqsen['value'] : '')}")}
        {$this->blockDescription($fqsen['description'], true)}
        **Type**: {$this->inlineType($fqsen['types'], false)}
        
        {$this->blockPrototype($fqsen['prototypes'])}
        {$this->blockSee($fqsen['tags']['see'] ?? [])}
        DETAILS,)}
        
        PROPERTY;
    }

    protected function blockMethod(array $fqsen): string
    {
        return <<<METHOD
        {$this->blockHeader(4, "{$this->inlineAttributes($fqsen['attributes'])}{$this->inlineMark($fqsen)}{$this->markdown($fqsen['name'])} {$this->inlineSmall($this->inlineSummary($fqsen['summary']))}", $fqsen['fqsen'])}
        {$this->blockAside([$this->inlineBadges($fqsen), $this->inlineSource($fqsen['location'])])}
        {$this->details($fqsen['summary'], <<<DETAILS
        {$this->blockDefinitation("{$this->inlineModifier($fqsen)} function {$fqsen['name']}{$this->inlineSignature($fqsen['parameters'], true)}{$this->concat(': ', $this->inlineType($fqsen['return']['types'], true))}")}
        {$this->blockDescription($fqsen['description'], true)}
        {$this->blockParameter($fqsen['parameters'])}
        {$this->blockReturn($fqsen['returns'])}
        {$this->blockThrows($fqsen['tags']['throws'] ?? [])}
        {$this->blockPrototype($fqsen['prototypes'])}
        {$this->blockSee($fqsen['tags']['see'] ?? [])}
        DETAILS,)}
        
        METHOD;
    }

    protected function blockHeader(int $level, string $title, string $id): string
    {
        $level = str_repeat('#', $level);
        $id = strtr(rtrim($id, '\\'), ['\\' => '-']);
        $anchor = strlen($id) ? "<a id='{$this->html($id)}' class='anchor'></a>" : '';
        return "$level {$anchor}{$title}\n";
    }

    protected function blockDescription(string $description, bool $second): string
    {
        if ($second) {
            $description = implode("\n", array_slice(explode("\n", trim($description)), 1));
        }
        if (!strlen($description)) {
            return '';
        }

        return <<<DESCRIPTION
        <div class="description">
        
        $description
        
        </div>
        
        DESCRIPTION;
    }

    protected function blockAside(array $asides): string
    {
        $asides = array_filter($asides, 'strlen');
        if (!count($asides)) {
            return '';
        }
        return <<<ASIDE
        ///right
        {$this->echo(implode("", $asides))}
        ///
        
        ASIDE;
    }

    protected function blockHierarchy(array $hierarchys, string $self): string
    {
        if (!count($hierarchys)) {
            return '';
        }
        $bolder = fn($name) => $name === $self ? '**' : '';
        $recursive = function ($hierarchys, $nest = 0) use (&$recursive, $bolder) {
            $indent = str_repeat(' ', $nest * 4);
            return $this->each($hierarchys, fn($hierarchy, $name) => <<<HIERARCHY
            {$indent}+ {$bolder($name)}{$this->inlineLink($name, $name)}{$bolder($name)}
            {$recursive($hierarchy, $nest + 1)}
            HIERARCHY, '');
        };
        return <<<HIERARCHYS
        **Hierarchy**
        
        {$recursive($hierarchys)}
        
        HIERARCHYS;
    }

    protected function blockConstruction(array $fqsens, string $title): string
    {
        if (!count($fqsens)) {
            return '';
        }
        return <<<CONSTRUCTION
        {$this->table($title, $fqsens, [
            [
                'header'  => 'type',
                'width'   => 20,
                'label'   => fn($fqsen) => '',
                'content' => fn($fqsen) => $this->inlineLink($fqsen['fqsen']),
            ],
            [
                'header'  => 'summary',
                'width'   => 80,
                'label'   => fn($fqsen) => '',
                'content' => fn($fqsen) => $this->inlineSummary($fqsen['summary']),
            ],
        ])}
        
        CONSTRUCTION;
    }

    protected function blockParent(array $fqsens): string
    {
        return $this->blockConstruction($fqsens, 'Parents');
    }

    protected function blockImplement(array $fqsens): string
    {
        return $this->blockConstruction($fqsens, 'Implements');
    }

    protected function blockUse(array $fqsens): string
    {
        return $this->blockConstruction($fqsens, 'Uses');
    }

    protected function blockDefinitation(string $value): string
    {
        if (!strlen($value)) {
            return '';
        }
        return <<<VALUE
        ```php:Definitation
        $value
        ```
        
        VALUE;
    }

    protected function blockParameter(array $parameters): string
    {
        if (!count($parameters)) {
            return '';
        }
        return <<<PARAMETERS
        {$this->table('Parameter', $parameters, [
            [
                'header'  => 'type',
                'width'   => 20,
                'label'   => fn($parameter) => $this->inlineAttributes($parameter['attributes']),
                'content' => fn($parameter) => $this->inlineType($parameter['types'], false),
            ],
            [
                'header'  => 'name',
                'width'   => 30,
                'label'   => fn($parameter) => '',
                'content' => fn($parameter) => $this->inlineCode($parameter['declaration']),
            ],
            [
                'header'  => 'summary',
                'width'   => 50,
                'label'   => fn($parameter) => '',
                'content' => fn($parameter) => $this->inlineSummary($parameter['summary']),
            ],
        ])}
        
        PARAMETERS;
    }

    protected function blockReturn(array $returns): string
    {
        if (!count($returns)) {
            return '';
        }
        return <<<RETURN
        {$this->table('Return', $returns, [
            [
                'header'  => 'type',
                'width'   => 20,
                'label'   => fn($return) => '',
                'content' => fn($return) => $this->inlineType($return['types'], false),
            ],
            [
                'header'  => 'summary',
                'width'   => 80,
                'label'   => fn($return) => '',
                'content' => fn($return) => $this->inlineSummary($return['summary']),
            ],
        ])}
        
        RETURN;
    }

    protected function blockThrows(array $throws): string
    {
        if (!count($throws)) {
            return '';
        }
        return <<<THROWS
        {$this->table('Throws', $throws, [
            [
                'header'  => 'type',
                'width'   => 20,
                'label'   => fn($throw) => '',
                'content' => fn($throw) => $this->inlineType([$throw['type']], false),
            ],
            [
                'header'  => 'summary',
                'width'   => 80,
                'label'   => fn($throw) => '',
                'content' => fn($throw) => $this->inlineSummary($throw['summary']),
            ],
        ])}
        
        THROWS;
    }

    protected function blockPrototype(array $prototypes): string
    {
        if (!count($prototypes)) {
            return '';
        }
        return <<<PROTOTYPES
        {$this->table('Prototype', $prototypes, [
            [
                'header'  => 'kind',
                'width'   => 20,
                'label'   => fn($prototype) => '',
                'content' => fn($prototype) => $prototype['kind'],
            ],
            [
                'header'  => 'source',
                'width'   => 30,
                'label'   => fn($prototype) => '',
                'content' => fn($prototype) => $this->inlineLink($prototype['fqsen']),
            ],
            [
                'header'  => 'summary',
                'width'   => 50,
                'label'   => fn($prototype) => '',
                'content' => fn($prototype) => $this->inlineSummary($prototype['summary']),
            ],
        ])}
        
        PROTOTYPES;
    }

    protected function blockSee(array $sees): string
    {
        if (!count($sees)) {
            return '';
        }
        return <<<SEES
        {$this->table('See', $sees, [
            [
                'header'  => 'type',
                'width'   => 30,
                'label'   => fn($see) => '',
                'content' => fn($see) => $this->inlineLink(is_string($see['type']) ? $see['type'] : $see['type']['fqsen']),
            ],
            [
                'header'  => 'summary',
                'width'   => 70,
                'label'   => fn($see) => '',
                'content' => fn($see) => $this->inlineSummary($see['summary']),
            ],
        ])}
        
        SEES;
    }

    protected function inlineMark(array $fqsen): string
    {
        if ($fqsen['category'] === 'namespace') {
            return "[N] ";
        }
        if ($fqsen['category'] === 'constant') {
            return "[C] ";
        }
        if ($fqsen['category'] === 'function') {
            return "[F] ";
        }
        if ($fqsen['category'] === 'class') {
            return "[C] ";
        }
        if ($fqsen['category'] === 'interface') {
            return "[I] ";
        }
        if ($fqsen['category'] === 'trait') {
            return "[T] ";
        }
        if ($fqsen['category'] === 'classconstant') {
            return "[C] ";
        }
        if ($fqsen['category'] === 'property') {
            $p = $fqsen['static'] ? 'P' : 'p';
            return "[$p] ";
        }
        if ($fqsen['category'] === 'method') {
            $m = $fqsen['static'] ? 'M' : 'm';
            return "[$m] ";
        }
        return '';
    }

    protected function inlineBadges(array $fqsen): string
    {
        $badges = [];
        if ($fqsen['cloneable'] ?? false) {
            $badges[] = "{cloneable}";
        }
        if ($fqsen['iterable'] ?? false) {
            $badges[] = "{iterable}";
        }
        if ($fqsen['magic'] ?? false) {
            $badges[] = "{magic}";
        }
        if ($fqsen['abstract'] ?? false) {
            $badges[] = "{abstract}";
        }
        if ($fqsen['final'] ?? false) {
            $badges[] = "{final}";
        }
        if ($fqsen['tags']['api'][0] ?? false) {
            $badges[] = "{success:api}";
        }
        if ($fqsen['tags']['version'][0] ?? false) {
            $badges[] = "{success:version {$fqsen['tags']['version'][0]['version']}}";
        }
        if ($fqsen['tags']['internal'][0] ?? false) {
            $badges[] = "{notice:internal}";
        }
        if ($fqsen['tags']['deprecated'][0] ?? false) {
            $badges[] = "{alert:deprecated {$fqsen['tags']['deprecated'][0]['start']}}";
        }
        return implode('', $badges);
    }

    protected function inlineAttributes(array $attributes): string
    {
        if (!count($attributes)) {
            return '';
        }

        $attrs = [];
        foreach ($attributes as $attribute) {
            $attrs[] = "{$attribute['name']}{$this->concat('(', $attribute['declaration'], ')')}";
        }
        return "<div data-attribute='{$this->html("#[" . implode(", ", $attrs) . "]")}'></div>";
    }

    protected function inlineModifier(array $fqsen): string
    {
        $modifiers = [];
        if ($fqsen['abstract'] ?? false) {
            $modifiers[] = "abstract";
        }
        if ($fqsen['final'] ?? false) {
            $modifiers[] = "final";
        }
        if ($fqsen['accessible'] ?? false) {
            $modifiers[] = $fqsen['accessible'];
        }
        if ($fqsen['static'] ?? false) {
            $modifiers[] = "static";
        }
        return implode(' ', $modifiers);
    }

    protected function inlineSummary(string $summary): string
    {
        return '<span class="summary">' . $this->html($summary) . '</span>';
    }

    protected function inlineSignature(array $parameters, bool $plain = true): string
    {
        if ($plain) {
            $delimiter = count($parameters) > 1 ? "\n    " : '';
            $terminator = count($parameters) > 1 ? "\n" : '';
            return "($delimiter{$this->each($parameters, fn($p) => $this->concat($this->inlineType($p['types'], $plain), ' ') . $p['declaration'], ",$delimiter")}$terminator)";
        }
        else {
            return "({$this->each($parameters, fn($p) => $this->concat($this->inlineType($p['types'], $plain), ' ') . $this->inlineCode($p['declaration']), ', ')})";
        }
    }

    protected function inlineType(array $types, bool $plain): string
    {
        if (!count($types)) {
            return '';
        }

        return $this->each($types, function ($type) use ($plain) {
            $result = '';
            if ($type['nullable']) {
                $result = '?';
            }
            if ($plain) {
                $result .= $type['fqsen'];
            }
            elseif ($type['category'] === 'pseudo') {
                $result .= $this->markdown($type['fqsen']);
            }
            else {
                $result .= $this->inlineLink($type['fqsen']);
            }
            $result .= str_repeat('[]', $type['array']);
            return $result;
        }, $plain ? '|' : '\\|​');
    }

    protected function inlineCode(string $text): string
    {
        if (!strlen($text)) {
            return '';
        }
        preg_match_all('#`+#', $text, $matches);
        $quote = str_repeat('`', max(array_map('strlen', $matches[0]) ?: [0]) + 1);
        $prefix = ($text[0] ?? '') === '`' ? "$quote " : $quote;
        $suffix = ($text[-1] ?? '') === '`' ? " $quote" : $quote;
        return "$prefix{$text}$suffix";
    }

    protected function inlineSmall(string $text): string
    {
        if (!strlen($text)) {
            return '';
        }
        return "<small>$text</small>";
    }

    protected function inlineLink(string $fqsen, ?string $content = null): string
    {
        if (is_string($content)) {
            $content = $this->markdown($content, '[]');
        }
        else {
            $parts = explode('\\', rtrim($fqsen, '\\'));
            $content = $this->markdown(end($parts), '[]');
        }

        if (preg_match('#^https?://#', $fqsen)) {
            return "[{$content}]({$fqsen} target=_blank)";
        }

        if ($fqsen[0] === '\\') {
            $manual = 'https://php.net/manual';
            if (in_array($fqsen, ['\\stdClass', '\\__PHP_Incomplete_Class'])) {
                return "[{$content}]($manual/reserved.classes.php target=_blank)";
            }
            if (preg_match('#(?<base>[0-9_a-z]+)(::)?(?<prop>\\$)?(?<member>[0-9_a-z]+)?(?<func>\\(\\))?($)#', ltrim(strtolower($fqsen), '\\'), $matches)) {
                $base = str_replace('_', '-', $matches['base']);
                $member = ltrim($matches['member'], '_');
                if (!strlen($matches['member']) && !strlen($matches['prop']) && strlen($matches['func'])) {
                    return "[{$content}]($manual/function.{$base}.php target=_blank)";
                }
                if (!strlen($matches['member']) && !strlen($matches['prop']) && !strlen($matches['func'])) {
                    return "[{$content}]($manual/class.{$base}.php target=_blank)";
                }
                if (strlen($matches['member']) && !strlen($matches['prop']) && !strlen($matches['func'])) {
                    return "[{$content}]($manual/class.{$base}.php#{$base}.constants.{$member} target=_blank)";
                }
                if (strlen($matches['member']) && strlen($matches['prop']) && !strlen($matches['func'])) {
                    return "[{$content}]($manual/class.{$base}.php#{$base}.props.{$member} target=_blank)";
                }
                if (strlen($matches['member']) && !strlen($matches['prop']) && strlen($matches['func'])) {
                    return "[{$content}]($manual/{$base}.{$member}.php target=_blank)";
                }
            }
            return "";
        }

        if ($this->existedFqsens[$fqsen] ?? false) {
            $anchor = urlencode(strtr(rtrim($fqsen, '\\'), ['\\' => '-']));
            return "[{$content}]({$this->existedFqsens[$fqsen]}.{$this->config['extension']}#{$anchor} \"$fqsen\")";
        }
        else {
            $anchor = urlencode(strtr(rtrim($fqsen, '\\'), ['\\' => '-']));
            return "[{$content}](#--$anchor)";
        }
    }

    protected function inlineSource(array $location): string
    {
        if (!$location['path']) {
            return '';
        }
        foreach ($this->config['source-map'] as $regex => $url) {
            if ($url instanceof \Closure) {
                if (is_int($regex)) {
                    $path = $url($location);
                    if (!$path) {
                        continue;
                    }
                    return "[]({$this->markdown($path, '()')} target=_blank)";
                }
                $path = preg_replace_callback("#$regex#u", $url, str_replace('\\', '/', $location['path']), 1, $replaced);
            }
            else {
                $path = preg_replace("#$regex#u", $url, str_replace('\\', '/', $location['path']), 1, $replaced);
            }
            if ($replaced && strlen($path)) {
                $localname = basename($path) . "#{$location['start']}~{$location['end']}";
                return "[{$this->markdown($localname, '[]')}]({$this->markdown($path, '()')}#L{$location['start']}-L{$location['end']} target=_blank)";
            }
        }
        return '';
    }

    private function table(string $caption, array $data, array $rules): string
    {
        $rows = [];
        foreach ($data as $no => $datum) {
            foreach ($rules as $rule) {
                $rows[$no][] = $rule['label']($datum) . $rule['content']($datum);
            }
        }
        return <<<TABLE
        :{$caption}
        {$this->each($rules, fn($rule) => $rule['header'], " | ")}
        {$this->each($rules, fn($rule) => str_repeat('-', $rule['width'] + 3), " | ")}
        {$this->each($rows, fn($row) => <<<ROW
        {$this->each($row, fn($td) => preg_replace("/\R/u", '<br>', trim("​$td")), " | ")}
        ROW, "\n")}
        TABLE;
    }

    private function details(string $summary, string $details): string
    {
        return <<<DETAILS
        ...$summary
        {$details}
        ...
        
        DETAILS;
    }

    private function markdown(string $string, string $characters = '!*_&[:<`~\\'): string
    {
        return addcslashes($string, $characters);
    }

    private function html(string $string, string $characters = '<>&"\''): string
    {
        $map = [
            '<' => '&lt;',
            '>' => '&gt;',
            '&' => '&amp;',
            '"' => '&quot;',
            "'" => '&apos;',
        ];
        return strtr($string, array_intersect_key($map, array_flip(str_split($characters))));
    }

    private function echo(string $string, string $default = ''): string
    {
        return strlen($string) ? $string : $default;
    }

    private function concat(?string ...$strings): string
    {
        $result = '';
        foreach ($strings as $string) {
            if (strlen($string = (string) $string) === 0) {
                return '';
            }
            $result .= $string;
        }
        return $result;
    }

    private function if(bool $condition, $true, $false = ""): string
    {
        return $condition ? $true : $false;
    }

    private function each(array $list, callable $callback, string $delimiter): string
    {
        return implode($delimiter, array_map($callback, $list, array_keys($list)));
    }
}
