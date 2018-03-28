<?php

namespace ryunosuke\Documentize;

use ryunosuke\Documentize\Utils\Adhoc;
use ryunosuke\Documentize\Utils\Arrays;
use ryunosuke\Documentize\Utils\Strings;

/**
 * タグパーサ
 *
 * @todo いつか個別に継承クラスで作り直す
 */
class Tag
{
    /** @var array タグの属性 */
    private $attributes;

    public function __construct($tagtext, $usings, $namespace, $own)
    {
        $inline = false;
        if (preg_match('#^\{(.*)\}$#', $tagtext, $m)) {
            $tagtext = $m[1];
            $inline = true;
        }

        $parts = preg_split('#\s+#', $tagtext, 2);
        $tagName = ltrim(trim($parts[0]), '@');
        $tagValue = $parts[1] ?? null;

        $this->attributes = [
            'tagname' => strtolower($tagName),
            'inline'  => $inline,
        ];
        $method = "parse" . strtr(ucwords($tagName, '-'), ['-' => '']);
        if (method_exists($this, $method)) {
            $this->attributes += $this->$method($tagValue, $usings, $namespace, $own);
        }
    }

    public function toArray()
    {
        return $this->attributes;
    }

    public function getInlineText()
    {
        if (!$this->attributes['inline']) {
            return null;
        }

        $custom = '';
        switch ($this->attributes['tagname']) {
            // inheritdoc だけは特別扱い
            /** @noinspection PhpMissingBreakStatementInspection */
            case 'inheritdoc':
                $custom = "HereIsInheritdoc";
            default:
                // カスタムタグっぽくタグ化して埋め込む（）
                // 値のみエスケープする。タグ名やキー名をエスケープしない理由は特に無いが、別に悪意あるものは来ないし、敢えてしないことで何かに活用できるかもしれない
                $attrs = array_diff_key($this->attributes, ['tagname' => null, 'inline' => null]);
                $attrs = Arrays::array_flatten($attrs, '-');
                $attrs = Arrays::array_sprintf($attrs, function ($v, $k) { return "data-$k='" . htmlspecialchars($v, ENT_QUOTES) . "'"; }, ' ');
                return "$custom<tag-{$this->attributes['tagname']} $attrs />";
        }
    }

    private function _addOwn($fqsen, $own)
    {
        // see タグなどはスコープを省略できる。その場合は自身とみなされる
        if (strpos($fqsen, '::') === false && $own) {
            // ただしプロパティ・メソッドのみ（phpstorm も対応していない。 hoge と書かれていても hoge か self::hoge か判断できないから？）
            if ($fqsen[0] === '$' || preg_match('#\\(\\)$#', $fqsen)) {
                $fqsen = '$this::' . $fqsen;
            }
        }
        return $fqsen;
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

    private function _parseTypeDescription($tagValue, $usings, $namespace, $own)
    {
        // @tagname ["Type"] [<description>]
        $value = preg_split('#\s+#', $tagValue, 2);
        return [
            'type'        => (new Fqsen($value[0]))->resolve($usings, $namespace, $own)[0],
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

    protected function parseInheritdoc($tagValue, $usings, $namespace, $own)
    {
        // @inheritdoc ["FQSEN"]
        return ['type' => strlen($tagValue) ? (new Fqsen($tagValue))->resolve($usings, $namespace, $own)[0] : null];
    }

    protected function parseInternal($tagValue)
    {
        return $this->_parseDescription($tagValue);
    }

    protected function parseLicense($tagValue)
    {
        // @license [<SPDX identifier>|URI] [name]
        $value = preg_split('#\s+#', $tagValue, 2);
        $type = filter_var($value[0], FILTER_VALIDATE_URL) ? 'uri' : 'spdx';
        return [
            'type'        => $type,
            'value'       => $value[0],
            'description' => $value[1] ?? '',
        ];
    }

    protected function parseLink($tagValue, $usings, $namespace, $own)
    {
        // インライン用法が異なるだけで @see と同じ
        return $this->parseSee($tagValue, $usings, $namespace, $own);
    }

    protected function parseMethod($tagValue)
    {
        // @method [return type] [name]([type] [parameter], [...]) [description]

        // よくわからない場合は空を返す（無理にパースしても後段のために良くない）
        if (!preg_match('#((?<static>static)\s*)?(?<type>[a-zA-z0-9\\_\[\]]+)\s+(?<name>[a-zA-z0-9_]+)(?=\()(?<remnant>.+)#ms', $tagValue, $matches)) {
            return [];
        }

        $args = Strings::str_between($matches['remnant'], '(', ')');
        if ($args === false) {
            return [];
        }

        $description = trim(str_replace("($args)", '', $matches['remnant']));

        // 引数は int|string のような記法も許されるため、個別にパースする必要がある
        // が、辛すぎるので タイプヒントだけ潰してあとは呼び元に任せる
        $parameters = $paramsTag = [];
        foreach (Adhoc::explode($args, ',', ['[' => ']', '"' => '"', "'" => "'"], '\\') as $param) {
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

        $paramsTag = implode("\n * ", $paramsTag);
        $returnTag = '@return ' . trim($matches['type']);

        // インライン phpdoc https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#54-inline-phpdoc
        if (preg_match('#^\{(.*)\}$#s', $description, $desc)) {
            $description = ltrim(preg_replace('#^ *#m', ' * ', trim($desc[1], "\r\n")), ' *');

            // インライン phpdoc が @param を含んでいるならそれを優先する（@method タグは型情報程度しか持てないため、phpdoc の方が情報量が多い）
            if (strpos($description, '@param') !== false) {
                $paramsTag = '';
            }
            // インライン phpdoc が @return を含んでいるならそれを優先する（@method タグは型情報程度しか持てないため、phpdoc の方が情報量が多い）
            if (strpos($description, '@return') !== false) {
                $returnTag = '';
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

    protected function parseParam($tagValue, $usings, $namespace, $own)
    {
        // @param ["Type"] [name] [<description>]
        $value = preg_split('#\s+#', $tagValue, 3);
        return [
            'type'        => (new Fqsen($value[0]))->resolve($usings, $namespace, $own),
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
            $description = ltrim(preg_replace('#^ *#m', ' * ', trim($desc[1], "\r\n")), ' *');
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

    protected function parseReturn($tagValue, $usings, $namespace, $own)
    {
        // @return ["Type"] [<description>]
        $value = preg_split('#\s+#', $tagValue, 2);
        return [
            'type'        => (new Fqsen($value[0]))->resolve($usings, $namespace, $own),
            'description' => $value[1] ?? '',
        ];
    }

    protected function parseSee($tagValue, $usings, $namespace, $own)
    {
        // @see [URI | "FQSEN"] [<description>]
        $value = preg_split('#\s+#', $tagValue, 2);
        $uri = filter_var($value[0], FILTER_VALIDATE_URL);
        return [
            'kind'        => $uri ? 'uri' : 'fqsen',
            'type'        => $uri ? $value[0] : (new Fqsen($this->_addOwn($value[0], $own)))->resolve($usings, $namespace, $own)[0],
            'description' => $value[1] ?? '',
        ];
    }

    protected function parseSince($tagValue)
    {
        return $this->_parseVersion($tagValue);
    }

    protected function parseThrows($tagValue, $usings, $namespace, $own)
    {
        return $this->_parseTypeDescription($tagValue, $usings, $namespace, $own);
    }

    protected function parseTodo($tagValue)
    {
        return $this->_parseDescription($tagValue);
    }

    protected function parseUses($tagValue, $usings, $namespace, $own)
    {
        return $this->_parseTypeDescription($tagValue, $usings, $namespace, $own);
    }

    protected function parseUsedBy($tagValue, $usings, $namespace, $own)
    {
        return $this->_parseTypeDescription($tagValue, $usings, $namespace, $own);
    }

    protected function parseVar($tagValue, $usings, $namespace, $own)
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
            'type'        => (new Fqsen($value[0]))->resolve($usings, $namespace, $own),
            'name'        => $name,
            'description' => $description ?? '',
        ];
    }

    protected function parseVersion($tagValue)
    {
        return $this->_parseVersion($tagValue);
    }
}
