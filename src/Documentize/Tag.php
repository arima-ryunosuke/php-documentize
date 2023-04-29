<?php

namespace ryunosuke\Documentize;

/**
 * タグパーサ
 *
 * @todo いつか個別に継承クラスで作り直す
 */
class Tag
{
    /// パースに必要な依存情報。内部的なもので引数で引き回すのも冗長なのでメンバーとしてもたせる
    private $usings, $namespace, $own, $last;

    /** @var array タグの属性 */
    private $attributes;

    /** @var array 関連する FQSEN */
    private $fqsens = [];

    public function __construct($tagtext, $usings, $namespace, $own, $last)
    {
        list($this->usings, $this->namespace, $this->own, $this->last) = [$usings, $namespace, $own, $last];

        // <@tag> は特殊なインラインタグ
        if (preg_match('#^<@([^\s]*)(.*)>$#', $tagtext, $m)) {
            $aliases = [
                'see'  => 'link',       // <@see> は「see しない link」として振る舞う
                'uses' => 'inheritdoc', // <@uses> は「inheritdoc + link」として振る舞う
            ];
            $tagName = strtolower($m[1]);
            $tagValue = trim($m[2]);

            $this->attributes = [
                'tagname' => $aliases[$tagName] ?? $m[1],
                'inline'  => $tagName,
            ];
        }
        // {@tag} は普通のインラインタグ
        elseif (preg_match('#^\{(.*)\}$#', $tagtext, $m)) {
            $parts = preg_split('#\s+#', $m[1], 2);
            $tagName = strtolower(ltrim(trim($parts[0]), '@'));
            $tagValue = $parts[1] ?? null;

            $this->attributes = [
                'tagname' => $tagName,
                'inline'  => $tagName,
            ];
        }
        // それ以外 @tag は普通のタグ
        else {
            $parts = preg_split('#\s+#', $tagtext, 2);
            $tagName = strtolower(ltrim(trim($parts[0]), '@'));
            $tagValue = $parts[1] ?? null;

            $this->attributes = [
                'tagname' => $tagName,
                'inline'  => false,
            ];
        }

        $method = "parse" . strtr(ucwords($tagName, '-'), ['-' => '']);
        if (method_exists($this, $method)) {
            $this->attributes += $this->$method($tagValue);
        }
    }

    public function toArray()
    {
        return $this->attributes;
    }

    public function getDependedFqsens()
    {
        return $this->fqsens;
    }

    public function getInlineText()
    {
        if (!$this->attributes['inline']) {
            return null;
        }

        $render = function ($tagname, $attribute, $content) {
            // meta タグで埋め込む
            // 値のみエスケープする。タグ名やキー名をエスケープしない理由は特に無いが、別に悪意あるものは来ないし、敢えてしないことで何かに活用できるかもしれない
            $attrs = array_diff_key($attribute, ['tagname' => null, 'inline' => null]);
            $attrs = array_flatten($attrs, '-');
            $attrs = array_sprintf($attrs, function ($v, $k) { return "data-$k='" . htmlspecialchars($v, ENT_QUOTES) . "'"; }, ' ');
            return "<tag_$tagname $attrs>$content</tag_$tagname>";
        };

        switch ($this->attributes['inline']) {
            // inheritdoc だけは特別扱い
            case 'inheritdoc':
                return $render('inheritdoc', $this->attributes, 'HereIsInheritdoc');
            case 'uses':
            case 'see':
            case 'link':
                $attributes = $this->attributes;
                $attributes['description'] = $attributes['description'] ?: $attributes['type']['fqsen'] ?? '';
                if ($this->attributes['inline'] === 'uses') {
                    $attributes['description'] = str_lchop($attributes['description'], $this->own . '::');
                }
                return $render('link', $attributes, $attributes['description']);
            case 'source':
                $attributes = $this->attributes;
                unset($attributes['location']); // ローカルパスが格納されているのでインラインでは伏せる
                $attributes['description'] = $attributes['description'] ?: $attributes['fqsen'];
                return $render('source', $attributes, $attributes['description']);
            default:
                return $render($this->attributes['inline'], $this->attributes, '');
        }
    }

    private function _resolveFqsen($fqsen, $addOwn)
    {
        // see タグなどはスコープを省略できる。その場合は自身とみなされる
        if ($addOwn && $this->own && strpos($fqsen, '::') === false) {
            // プロパティ・メソッドは判別できるが、定数は不可。のですべて大文字は定数とみなす
            if ($fqsen[0] === '$' || preg_match('#\\(\\)$#', $fqsen) || preg_match('#^[A-Z_0-9]+$#', $fqsen)) {
                $fqsen = '$this::' . $fqsen;
            }
        }
        $result = (new Fqsen($fqsen))->resolve($this->usings, $this->namespace, $this->own);
        $this->fqsens = array_merge($this->fqsens, array_column($result, 'fqsen'));
        return $result;
    }

    private function _validUri($value)
    {
        // filter_val を通過すれば万事OK
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }
        // 他のプロジェクトを見ていると www.hoge のようなホスト名だけ書かれているケースが散見されるのでスキーム省略もOKとする
        if (strpos($value, '.') !== false || strpos($value, '/') !== false) {
            // 敢えてスキームを付けたりせずそのまま返す（普通はホスト名を開けばブラウザで補完してくれるはず）
            return $value;
        }
        return false;
    }

    private function _parseNovalue()
    {
        // @tagname
        return [];
    }

    private function _parseDescription($tagValue)
    {
        // @tagname [Description]
        $value = preg_split('#\s+#', $tagValue, 1);
        return [
            'description' => $value[0] ?? '',
        ];
    }

    private function _parseTypeDescription($addOwn, $tagValue)
    {
        // @tagname ["Type"] [<description>]
        $value = preg_split('#\s+#', $tagValue, 2);
        return [
            'type'        => strlen($value[0]) ? $this->_resolveFqsen($value[0], $addOwn)[0] : null,
            'description' => $value[1] ?? '',
        ];
    }

    private function _parseVersion($tagValue)
    {
        // @tagname ["Semantic Version"] [<description>]
        preg_match('#(?<version>\d{1,}\.\d{1,}\.\d{1,})\s*(?<description>.*)#', $tagValue, $matches);
        return [
            'version'     => trim($matches['version'] ?? ''),
            'description' => trim($matches['description'] ?? $tagValue),
        ];
    }

    protected function parseApi()
    {
        return $this->_parseNovalue();
    }

    protected function parseAuthor($tagValue)
    {
        // @author [name] [<email address>]
        preg_match('#(?<name>[^<>]*)(?<email><.*>)?#', $tagValue, $matches);
        return [
            'name'  => trim($matches['name'] ?? $tagValue),
            'email' => trim($matches['email'] ?? ''),
        ];
    }

    protected function parseCopyright($tagValue)
    {
        return $this->_parseDescription($tagValue);
    }

    protected function parseDeprecated($tagValue)
    {
        // @deprecated [<"Semantic Version">][:<"Semantic Version">] [<description>]
        preg_match('#(?<start>\d{1,}\.\d{1,}\.\d{1,})?(:(?<end>\d{1,}\.\d{1,}\.\d{1,}))?\s*(?<description>.*)#', $tagValue, $matches);
        return [
            'start'       => trim($matches['start'] ?? ''),
            'end'         => trim($matches['end'] ?? ''),
            'description' => trim($matches['description'] ?? $tagValue),
        ];
    }

    protected function parseExample($tagValue)
    {
        // @example [URI] [<description>]
        $value = preg_split('#\s+#', $tagValue, 2);
        return [
            'uri'         => $value[0],
            'description' => $value[1] ?? '',
        ];
    }

    protected function parseIgnore()
    {
        return $this->_parseNovalue();
    }

    protected function parseIgnoreInherit()
    {
        return $this->_parseNovalue();
    }

    protected function parseInheritdoc($tagValue)
    {
        return $this->_parseTypeDescription(true, $tagValue);
    }

    protected function parseInternal($tagValue)
    {
        return $this->_parseDescription($tagValue);
    }

    protected function parseLicense($tagValue)
    {
        // @license [<SPDX identifier>|URI] [name]
        $value = preg_split('#\s+#', $tagValue, 2);
        $uri = $this->_validUri($value[0]);
        return [
            'type'        => $uri ? 'uri' : 'spdx',
            'value'       => $uri ?: $value[0],
            'description' => $value[1] ?? '',
        ];
    }

    protected function parseLink($tagValue)
    {
        // インライン用法が異なるだけで @see と同じ
        return $this->parseSee($tagValue);
    }

    protected function parseMethod($tagValue)
    {
        // @method [return type] [name]([type] [parameter], [...]) [description]

        // よくわからない場合は空を返す（無理にパースしても後段のために良くない）
        if (!preg_match('#((?<static>static)\s*)?(?<type>\$?[a-zA-z0-9\\|\\_\[\]]+)\s+(?<name>[a-zA-z0-9_]+)(?=\()(?<remnant>.+)#ms', $tagValue, $matches)) {
            return [];
        }

        $args = str_between($matches['remnant'], '(', ')');
        if ($args === false) {
            return [];
        }

        // 引数は int|string のような記法も許されるため、個別にパースする必要がある
        // が、辛すぎるので タイプヒントだけ潰してあとは呼び元に任せる
        $parameters = $paramsTag = [];
        foreach (array_filter(quoteexplode(',', $args, null, ['[' => ']', '"' => '"', "'" => "'"], '\\'), 'strlen') as $param) {
            $parts = preg_split('#\s+(?=[$.&])#u', trim($param), 2);
            if (isset($parts[1])) {
                $type = array_shift($parts);
                $parameter = $parts[0];
            }
            else {
                $type = 'mixed';
                $parameter = trim($param);
            }
            $parameters[] = $parameter;
            $paramsTag[] = "@param $type " . preg_replace('#[^$0-9a-z]#i', '', explode('=', $parameter)[0]);
        }

        if (($this->last[1] ?? null) === '*') {
            $last = strtr($this->last, ['@**' => '/**', '*@' => '*/']);
            return [
                'static'     => !!$matches['static'],
                'name'       => $matches['name'],
                'parameter'  => implode(', ', $parameters),
                'doccomment' => rtrim($last) . "\n",
            ];
        }

        $paramsTag = implode("\n * ", $paramsTag);
        $returnTag = '@return ' . trim($matches['type']);

        // インライン phpdoc https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#54-inline-phpdoc
        $description = trim(str_subreplace($matches['remnant'], "($args)", [0 => '']));
        if (preg_match('#^\{(.*)\}$#s', $description, $desc)) {
            $description = ltrim(preg_replace('#^ {4}#m', ' * ', trim($desc[1], "\r\n")), ' *');

            // インライン phpdoc が @param を含んでいるならそれを優先する（@method タグは型情報程度しか持てないため、phpdoc の方が情報量が多い）
            if (strpos($description, '* @param') !== false) {
                $paramsTag = '';
            }
            // インライン phpdoc が @return を含んでいるならそれを優先する（@method タグは型情報程度しか持てないため、phpdoc の方が情報量が多い）
            if (strpos($description, '* @return') !== false) {
                $returnTag = '';
            }
            // インライン phpdoc が @inherit を含んでいるならそれを優先する（@method タグは型情報程度しか持てないため、phpdoc の方が情報量が多い）
            if (strpos($description, '@inheritdoc') !== false) {
                $description = str_replace('@inheritdoc', "\n * @inheritdoc", $description);
            }
        }

        $doccomment = "/**
 * $description
 * 
 * $paramsTag
 * $returnTag
 */
";
        return [
            'static'     => !!$matches['static'],
            'name'       => $matches['name'],
            'parameter'  => implode(', ', $parameters),
            'doccomment' => $doccomment,
        ];
    }

    protected function parsePackage($tagValue)
    {
        // @package [level 1]\[level 2]\[etc.]
        $value = preg_split('#\s+#', $tagValue, 1);
        return [
            'namespace' => trim(ltrim($value[0] ?? '', '\\')),
        ];
    }

    protected function parseParam($tagValue)
    {
        // @param ["Type"] [name] [<description>]
        $value = preg_split('#\s+#', $tagValue, 3);
        return [
            'type'        => $this->_resolveFqsen($value[0], false),
            'name'        => ltrim($value[1] ?? '', '$.'),
            'description' => $value[2] ?? '',
        ];
    }

    protected function parseProperty($tagValue)
    {
        // @property ["Type"] [name] [<description>]
        // よくわからない場合は空を返す（無理にパースしても後段のために良くない）
        if (!preg_match('#((?<static>static)\s*)?(?<type>[a-zA-z0-9\\_\[\]]+)\s+(?<name>\$[a-zA-z0-9_]+)(?<remnant>.*)#ms', $tagValue, $matches)) {
            return [];
        }

        $description = trim($matches['remnant']);

        // インライン phpdoc https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#54-inline-phpdoc
        if (preg_match('#^\{(.*)\}$#s', $description, $desc)) {
            $description = ltrim(preg_replace('#^ {4}#m', ' * ', trim($desc[1], "\r\n")), ' *');
        }

        $varTag = '@var ' . trim($matches['type']);

        $doccomment = "/**
 * $description
 * 
 * $varTag
 */
";
        return [
            'static'     => !!$matches['static'],
            'name'       => ltrim($matches['name'], '$'),
            'doccomment' => $doccomment,
        ];
    }

    protected function parseReturn($tagValue)
    {
        // @return ["Type"] [<description>]
        $value = preg_split('#\s+#', $tagValue, 2);
        return [
            'type'        => $this->_resolveFqsen($value[0], false),
            'description' => $value[1] ?? '',
        ];
    }

    protected function parseSee($tagValue)
    {
        // @see [URI | "FQSEN"] [<description>]
        $value = preg_split('#\s+#', $tagValue, 2);
        $uri = $this->_validUri($value[0]);
        return [
            'kind'        => $uri ? 'uri' : 'fqsen',
            'type'        => $uri ?: $this->_resolveFqsen($value[0], true)[0],
            'description' => $value[1] ?? '',
        ];
    }

    protected function parseSince($tagValue)
    {
        return $this->_parseVersion($tagValue);
    }

    protected function parseSource($tagValue)
    {
        // @source ["Type"] [<description>]
        $value = preg_split('#\s+#', $tagValue, 2);
        $fqsen = $this->_resolveFqsen($value[0], true)[0];
        // このタグは特別扱いでいきなり new Reflection するので try catch が必要（でないと見つからないクラスで即死する）
        $ref = try_null([Reflection::class, 'instance'], $fqsen['fqsen']);
        return [
            'fqsen'       => $fqsen['fqsen'],
            'location'    => optional($ref)->getLocation(),
            'description' => $value[1] ?? '',
        ];
    }

    protected function parseThrows($tagValue)
    {
        return $this->_parseTypeDescription(false, $tagValue);
    }

    protected function parseTodo($tagValue)
    {
        return $this->_parseDescription($tagValue);
    }

    protected function parseUses($tagValue)
    {
        return $this->_parseTypeDescription(true, $tagValue);
    }

    protected function parseUsedBy($tagValue)
    {
        return $this->_parseTypeDescription(true, $tagValue);
    }

    protected function parseVar($tagValue)
    {
        // @var ["Type"] [element_name] [<description>]
        // プロパティでの使用を想定しているが、本来の @var タグは「その要素名」まで含めて指定する
        // プロパティでの @var は特例的に省略が認められているに過ぎない
        // Name と Description の判別は骨が折れるので単純に $ で始まっていれば Name、でなければ Description とする
        $value = preg_split('#\s+#', $tagValue, 2);
        $name = '';
        $description = $value[1] ?? '';
        if (isset($description[0]) && $description[0] === '$') {
            $parts = preg_split('#\s+#', $description, 2);
            $name = $parts[0];
            $description = $parts[1] ?? '';
        }
        return [
            'type'        => $this->_resolveFqsen($value[0], false),
            'name'        => $name,
            'description' => $description ?? '',
        ];
    }

    protected function parseVersion($tagValue)
    {
        return $this->_parseVersion($tagValue);
    }
}
