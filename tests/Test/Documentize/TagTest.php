<?php

namespace ryunosuke\Test\Documentize;

use ryunosuke\Documentize\Tag;

class TagTest extends \ryunosuke\Test\AbstractUnitTestCase
{
    function assertTag(Tag $actual, $expected)
    {
        $this->assertEquals($expected, $actual->toArray());
    }

    function test___construct()
    {
        $this->assertTag(new Tag('@version 1.2.3', [], null, null, null), [
            'tagname'     => 'version',
            'inline'      => false,
            'version'     => '1.2.3',
            'description' => '',
        ]);

        $this->assertTag(new Tag('{@version 1.2.3 description}', [], null, null, null), [
            'tagname'     => 'version',
            'inline'      => 'version',
            'version'     => '1.2.3',
            'description' => 'description',
        ]);

        $this->assertTag(new Tag('@hoge', [], null, null, null), [
            'tagname' => 'hoge',
            'inline'  => false,
        ]);

        $this->assertTag(new Tag('{@hoge}', [], null, null, null), [
            'tagname' => 'hoge',
            'inline'  => 'hoge',
        ]);

        $this->assertTag(new Tag('<@see hoge() description>', [], null, null, null), [
            'tagname'     => 'link',
            'inline'      => 'see',
            'kind'        => 'fqsen',
            'type'        => [
                'category' => 'type',
                'fqsen'    => 'hoge()',
                'array'    => 0,
                'nullable' => false,
            ],
            'description' => 'description',
        ]);

        $this->assertTag(new Tag('<@uses hoge() description>', [], null, null, null), [
            'tagname'     => 'inheritdoc',
            'inline'      => 'uses',
            'type'        => [
                'category' => 'type',
                'fqsen'    => 'hoge()',
                'array'    => 0,
                'nullable' => false,
            ],
            'description' => 'description',
        ]);
    }

    function test_getDependedFqsens()
    {
        // fqsen を持たないタグは空
        $tag = new Tag('@todo noinline', [], null, null, null);
        $this->assertEquals([], $tag->getDependedFqsens());

        // fqsen を持つタグはそれを
        $tag = new Tag('@param int|string', [], null, null, null);
        $this->assertEquals(['int', 'string'], $tag->getDependedFqsens());
    }

    function test_getInlineText()
    {
        // インラインでなければ null
        $tag = new Tag('@todo noinline', [], null, null, null);
        $this->assertSame(null, $tag->getInlineText());

        // インラインならタグ化される
        $tag = new Tag('{@todo noinline}', [], null, null, null);
        $this->assertEquals("<tag_todo data-description='noinline'></tag_todo>", $tag->getInlineText());

        // 特殊なインライン
        $tag = new Tag('<@see stdclass>', [], null, null, null);
        $this->assertEquals("<tag_link data-kind='fqsen' data-type-category='class' data-type-fqsen='\stdClass' data-type-array='0' data-type-nullable='' data-description='\\stdClass'>\\stdClass</tag_link>", $tag->getInlineText());
        $tag = new Tag('<@uses stdclass>', [], null, null, null);
        $this->assertEquals("<tag_link data-type-category='class' data-type-fqsen='\stdClass' data-type-array='0' data-type-nullable='' data-description='\\stdClass'>\\stdClass</tag_link>", $tag->getInlineText());

        // link
        $tag = new Tag('{@link stdclass}', [], null, null, null);
        $this->assertEquals("<tag_link data-kind='fqsen' data-type-category='class' data-type-fqsen='\stdClass' data-type-array='0' data-type-nullable='' data-description='\\stdClass'>\\stdClass</tag_link>", $tag->getInlineText());

        // source
        $__method__ = __METHOD__;
        $tag = new Tag("{@source $__method__}", [], null, null, null);
        $this->assertEquals("<tag_source data-fqsen='$__method__()' data-description='$__method__()'>$__method__()</tag_source>", $tag->getInlineText());

        // inheritdoc
        $tag = new Tag('{@inheritdoc stdclass}', [], null, null, null);
        $this->assertEquals("<tag_inheritdoc data-type-category='class' data-type-fqsen='\stdClass' data-type-array='0' data-type-nullable='' data-description=''>HereIsInheritdoc</tag_inheritdoc>", $tag->getInlineText());
    }

    function test_parseApi()
    {
        $this->assertTag(new Tag('@api', [], null, null, null), [
            'tagname' => 'api',
            'inline'  => false,
        ]);
    }

    function test_parseAuthor()
    {
        $this->assertTag(new Tag('@author this is name <this@is.email>', [], null, null, null), [
            'tagname' => 'author',
            'inline'  => false,
            'name'    => 'this is name',
            'email'   => '<this@is.email>',
        ]);

        $this->assertTag(new Tag('@author this is name', [], null, null, null), [
            'tagname' => 'author',
            'inline'  => false,
            'name'    => 'this is name',
            'email'   => '',
        ]);
    }

    function test_parseCopyright()
    {
        $this->assertTag(new Tag('@copyright this is description.', [], null, null, null), [
            'tagname'     => 'copyright',
            'inline'      => false,
            'description' => 'this is description.',
        ]);
    }

    function test_parseDeprecated()
    {
        $this->assertTag(new Tag('@deprecated 1.0.0:2.0.0 this is description.', [], null, null, null), [
            'tagname'     => 'deprecated',
            'inline'      => false,
            'start'       => '1.0.0',
            'end'         => '2.0.0',
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@deprecated 1.0.0:2.0.0', [], null, null, null), [
            'tagname'     => 'deprecated',
            'inline'      => false,
            'start'       => '1.0.0',
            'end'         => '2.0.0',
            'description' => '',
        ]);

        $this->assertTag(new Tag('@deprecated 1.0.0', [], null, null, null), [
            'tagname'     => 'deprecated',
            'inline'      => false,
            'start'       => '1.0.0',
            'end'         => '',
            'description' => '',
        ]);

        $this->assertTag(new Tag('@deprecated :2.0.0', [], null, null, null), [
            'tagname'     => 'deprecated',
            'inline'      => false,
            'start'       => '',
            'end'         => '2.0.0',
            'description' => '',
        ]);
    }

    function test_parseExample()
    {
        $this->assertTag(new Tag('@example http://example.com this is description.', [], null, null, null), [
            'tagname'     => 'example',
            'inline'      => false,
            'uri'         => 'http://example.com',
            'description' => 'this is description.',
        ]);
    }

    function test_parseIgnore()
    {
        $this->assertTag(new Tag('@ignore', [], null, null, null), [
            'tagname' => 'ignore',
            'inline'  => false,
        ]);
    }

    function test_parseIgnoreinherit()
    {
        $this->assertTag(new Tag('@ignoreinherit', [], null, null, null), [
            'tagname' => 'ignoreinherit',
            'inline'  => false,
        ]);
    }

    function test_parseInheritdoc()
    {
        $this->assertTag(new Tag('@inheritdoc', [], null, null, null), [
            'tagname'     => 'inheritdoc',
            'inline'      => false,
            'type'        => null,
            'description' => ''
        ]);

        $this->assertTag(new Tag('@inheritdoc ArrayObject', [], null, null, null), [
            'tagname'     => 'inheritdoc',
            'inline'      => false,
            'type'        => [
                'category' => 'class',
                'fqsen'    => '\\ArrayObject',
                'array'    => 0,
                'nullable' => false,
            ],
            'description' => ''
        ]);

        $this->assertTag(new Tag('@inheritdoc ArrayObject::method()', [], null, null, null), [
            'tagname'     => 'inheritdoc',
            'inline'      => false,
            'type'        => [
                'category' => 'method',
                'fqsen'    => '\\ArrayObject::method()',
                'array'    => 0,
                'nullable' => false,
            ],
            'description' => ''
        ]);

        $this->assertTag(new Tag('@inheritdoc ArrayObject::method() hogera', [], null, null, null), [
            'tagname'     => 'inheritdoc',
            'inline'      => false,
            'type'        => [
                'category' => 'method',
                'fqsen'    => '\\ArrayObject::method()',
                'array'    => 0,
                'nullable' => false,
            ],
            'description' => 'hogera'
        ]);
    }

    function test_parseInternal()
    {
        $this->assertTag(new Tag('@internal this is description.', [], null, null, null), [
            'tagname'     => 'internal',
            'inline'      => false,
            'description' => 'this is description.',
        ]);
    }

    function test_parseLicense()
    {
        $this->assertTag(new Tag('@license http://example.com this is description.', [], null, null, null), [
            'tagname'     => 'license',
            'inline'      => false,
            'type'        => 'uri',
            'value'       => 'http://example.com',
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@license example.com this is description.', [], null, null, null), [
            'tagname'     => 'license',
            'inline'      => false,
            'type'        => 'uri',
            'value'       => 'example.com',
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@license MIT', [], null, null, null), [
            'tagname'     => 'license',
            'inline'      => false,
            'type'        => 'spdx',
            'value'       => 'MIT',
            'description' => '',
        ]);
    }

    function test_parseLink()
    {
        $this->assertTag(new Tag('@link ArrayObject[] this is description.', [], null, null, null), [
            'tagname'     => 'link',
            'inline'      => false,
            'kind'        => 'fqsen',
            'type'        => [
                'category' => 'class',
                'fqsen'    => '\\ArrayObject',
                'array'    => 1,
                'nullable' => false,
            ],
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@link http://example.com this is description.', [], null, null, null), [
            'tagname'     => 'link',
            'inline'      => false,
            'kind'        => 'uri',
            'type'        => 'http://example.com',
            'description' => 'this is description.',
        ]);
    }

    function test_parseMethod()
    {
        $this->assertTag(new Tag('@method sityaka metyaka', [], null, null, null), [
            'tagname' => 'method',
            'inline'  => false,
        ]);

        $this->assertTag(new Tag('@method sityaka name((((( description', [], null, null, null), [
            'tagname' => 'method',
            'inline'  => false,
        ]);

        $this->assertTag(new Tag('@method ArrayObject methodName($arg1, &$arg2, ...$args) this is description.', [], null, null, null), [
            'tagname'    => 'method',
            'inline'     => false,
            'static'     => false,
            'name'       => 'methodName',
            'parameter'  => '$arg1, &$arg2, ...$args',
            'doccomment' => '/**
 * this is description.
 * 
 * @param mixed $arg1
 * @param mixed $arg2
 * @param mixed $args
 * @return ArrayObject
 */
',
        ]);

        $this->assertTag(new Tag('@method ArrayObject methodName(int|string $multitype, $arg1 = array(), $arg2 = ["1, 2", 3]) this is description (brace).', [], null, null, null), [
            'tagname'    => 'method',
            'inline'     => false,
            'static'     => false,
            'name'       => 'methodName',
            'parameter'  => '$multitype, $arg1 = array(), $arg2 = ["1, 2", 3]',
            'doccomment' => '/**
 * this is description (brace).
 * 
 * @param int|string $multitype
 * @param mixed $arg1
 * @param mixed $arg2
 * @return ArrayObject
 */
',
        ]);

        $this->assertTag(new Tag('@method ArrayObject methodName(int|string $multitype, Type &$refdef = null)', [], null, null, null), [
            'tagname'    => 'method',
            'inline'     => false,
            'static'     => false,
            'name'       => 'methodName',
            'parameter'  => '$multitype, &$refdef = null',
            'doccomment' => '/**
 * 
 * 
 * @param int|string $multitype
 * @param Type $refdef
 * @return ArrayObject
 */
',
        ]);

        $this->assertTag(new Tag('@method int methodName($arg1, &$arg2, ...$args) {
    this is description.
    
    this is description.
    
    @param string $arg1 arg1 is ...
    @param string $arg2 arg2 is ...
    @param array $args args are ...
    @return array returnType is ...
}', [], null, null, null), [
            'tagname'    => 'method',
            'inline'     => false,
            'static'     => false,
            'name'       => 'methodName',
            'parameter'  => '$arg1, &$arg2, ...$args',
            'doccomment' => '/**
 * this is description.
 * 
 * this is description.
 * 
 * @param string $arg1 arg1 is ...
 * @param string $arg2 arg2 is ...
 * @param array $args args are ...
 * @return array returnType is ...
 * 
 * 
 * 
 */
',
        ]);

        $this->assertTag(new Tag('@method static ArrayObject methodName(int|string $multitype, Type &$refdef = null) {
    description
}', [], null, null, null), [
            'tagname'    => 'method',
            'inline'     => false,
            'static'     => true,
            'name'       => 'methodName',
            'parameter'  => '$multitype, &$refdef = null',
            'doccomment' => '/**
 * description
 * 
 * @param int|string $multitype
 * @param Type $refdef
 * @return ArrayObject
 */
',
        ]);

        $this->assertTag(new Tag('@method $this methodName($arg1, &$arg2, ...$args) {
    this is description.
    
    @param string $arg1 arg1 is ...
    @param string $arg2 arg2 is ...
    @param array $args args are ...
}', [], null, null, null), [
            'tagname'    => 'method',
            'inline'     => false,
            'static'     => false,
            'name'       => 'methodName',
            'parameter'  => '$arg1, &$arg2, ...$args',
            'doccomment' => '/**
 * this is description.
 * 
 * @param string $arg1 arg1 is ...
 * @param string $arg2 arg2 is ...
 * @param array $args args are ...
 * 
 * 
 * @return $this
 */
',
        ]);

        $this->assertTag(new Tag('@method ArrayObject methodName($arg1, &$arg2, ...$args) {
    this is description.
    
    this is description.
    
    @param string $arg1 arg1 is ...
    @param string $arg2 arg2 is ...
    @param array $args args are ...
}', [], null, null, null), [
            'tagname'    => 'method',
            'inline'     => false,
            'static'     => false,
            'name'       => 'methodName',
            'parameter'  => '$arg1, &$arg2, ...$args',
            'doccomment' => '/**
 * this is description.
 * 
 * this is description.
 * 
 * @param string $arg1 arg1 is ...
 * @param string $arg2 arg2 is ...
 * @param array $args args are ...
 * 
 * 
 * @return ArrayObject
 */
',
        ]);

        $this->assertTag(new Tag('@method void methodName() {
    this is description.
    
    - list 1
        - list 1-2
    - list 2
    
    ```php
    var_dump([
        "code",
        "block",
    ]);
    ```
    @inheritdoc
}', [], null, null, null), [
            'tagname'    => 'method',
            'inline'     => false,
            'static'     => false,
            'name'       => 'methodName',
            'parameter'  => '',
            'doccomment' => '/**
 * this is description.
 * 
 * - list 1
 *     - list 1-2
 * - list 2
 * 
 * ```php
 * var_dump([
 *     "code",
 *     "block",
 * ]);
 * ```
 * 
 * @inheritdoc
 * 
 * 
 * @return void
 */
',
        ]);

        $this->assertTag(new Tag('@method void methodName()', [], null, null, '@**
 * this is description.
 * 
 * - list 1
 *     - list 1-2
 * - list 2
 * 
 * ```php
 * var_dump([
 *     "code",
 *     "block",
 * ]);
 * ```
 * @inheritdoc
 *@'), [
            'tagname'    => 'method',
            'inline'     => false,
            'static'     => false,
            'name'       => 'methodName',
            'parameter'  => '',
            'doccomment' => '/**
 * this is description.
 * 
 * - list 1
 *     - list 1-2
 * - list 2
 * 
 * ```php
 * var_dump([
 *     "code",
 *     "block",
 * ]);
 * ```
 * @inheritdoc
 */
',
        ]);
    }

    function test_parsePackage()
    {
        $this->assertTag(new Tag('@package \\fullname', [], null, null, null), [
            'tagname'   => 'package',
            'inline'    => false,
            'namespace' => 'fullname',
        ]);
    }

    function test_parseParam()
    {
        $this->assertTag(new Tag('@param ArrayObject[] $name this is description.', [], null, null, null), [
            'tagname'     => 'param',
            'inline'      => false,
            'name'        => 'name',
            'type'        => [
                [
                    'category' => 'class',
                    'fqsen'    => '\\ArrayObject',
                    'array'    => 1,
                    'nullable' => false,
                ],
            ],
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@param ArrayObject[]|array $name', [], null, null, null), [
            'tagname'     => 'param',
            'inline'      => false,
            'name'        => 'name',
            'type'        => [
                [
                    'category' => 'class',
                    'fqsen'    => '\\ArrayObject',
                    'array'    => 1,
                    'nullable' => false,
                ],
                [
                    'category' => 'pseudo',
                    'fqsen'    => 'array',
                    'array'    => 0,
                    'nullable' => false,
                ],
            ],
            'description' => '',
        ]);
    }

    function test_parseProperty()
    {
        $this->assertTag(new Tag('@property sityaka metyaka', [], null, null, null), [
            'tagname' => 'property',
            'inline'  => false,
        ]);

        $this->assertTag(new Tag('@property ArrayObject[] $name this is description.', [], null, null, null), [
            'tagname'    => 'property',
            'inline'     => false,
            'name'       => 'name',
            'static'     => false,
            'doccomment' => '/**
 * this is description.
 * 
 * @var ArrayObject[]
 */
',
        ]);

        $this->assertTag(new Tag('@property static ArrayObject[]|array $name', [], null, null, null), [
            'tagname'    => 'property',
            'inline'     => false,
            'name'       => 'name',
            'static'     => false,
            'doccomment' => '/**
 * 
 * 
 * @var array
 */
',
        ]);

        $this->assertTag(new Tag('@property ArrayObject[] $name {
    description
}', [], null, null, null), [
            'tagname'    => 'property',
            'inline'     => false,
            'name'       => 'name',
            'static'     => false,
            'doccomment' => '/**
 * description
 * 
 * @var ArrayObject[]
 */
',
        ]);
    }

    function test_parseReturn()
    {
        $this->assertTag(new Tag('@return ArrayObject[] this is description.', [], null, null, null), [
            'tagname'     => 'return',
            'inline'      => false,
            'type'        => [
                [
                    'category' => 'class',
                    'fqsen'    => '\\ArrayObject',
                    'array'    => 1,
                    'nullable' => false,
                ]
            ],
            'description' => 'this is description.',
        ]);
    }

    function test_parseSee()
    {
        $this->assertTag(new Tag('@see ArrayObject[] this is description.', [], null, null, null), [
            'tagname'     => 'see',
            'inline'      => false,
            'kind'        => 'fqsen',
            'type'        => [
                'category' => 'class',
                'fqsen'    => '\\ArrayObject',
                'array'    => 1,
                'nullable' => false,
            ],
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@see http://example.com this is description.', [], null, null, null), [
            'tagname'     => 'see',
            'inline'      => false,
            'kind'        => 'uri',
            'type'        => 'http://example.com',
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@see http://example.com', [], null, null, null), [
            'tagname'     => 'see',
            'inline'      => false,
            'kind'        => 'uri',
            'type'        => 'http://example.com',
            'description' => '',
        ]);

        $this->assertTag(new Tag('@see example.com', [], null, null, null), [
            'tagname'     => 'see',
            'inline'      => false,
            'kind'        => 'uri',
            'type'        => 'example.com',
            'description' => '',
        ]);

        $this->assertTag(new Tag('@see $property', [], null, 'ClassName', null), [
            'tagname'     => 'see',
            'inline'      => false,
            'kind'        => 'fqsen',
            'type'        => [
                'category' => 'property',
                'fqsen'    => 'ClassName::$property',
                'array'    => 0,
                'nullable' => false,
            ],
            'description' => '',
        ]);

        $this->assertTag(new Tag('@see method()', [], null, 'ClassName', null), [
            'tagname'     => 'see',
            'inline'      => false,
            'kind'        => 'fqsen',
            'type'        => [
                'category' => 'method',
                'fqsen'    => 'ClassName::method()',
                'array'    => 0,
                'nullable' => false,
            ],
            'description' => '',
        ]);
    }

    function test_parseSince()
    {
        $this->assertTag(new Tag('@since 1.2.3 this is description.', [], null, null, null), [
            'tagname'     => 'since',
            'inline'      => false,
            'version'     => '1.2.3',
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@since', [], null, null, null), [
            'tagname'     => 'since',
            'inline'      => false,
            'version'     => '',
            'description' => '',
        ]);
    }

    function test_parseSource()
    {
        $method = __METHOD__;
        $rmethod = \ryunosuke\Documentize\reflect_callable($method);
        $sline = $rmethod->getStartLine();
        $eline = $rmethod->getEndLine();
        $this->assertTag(new Tag("@source $method", [], null, null, null), [
            'tagname'     => 'source',
            'inline'      => false,
            'fqsen'       => "$method()",
            'description' => '',
            'location'    => [
                'path'  => __FILE__,
                'start' => $sline,
                'end'   => $eline,
            ],
        ]);
        $this->assertTag(new Tag("@source $method this is description.", [], null, null, null), [
            'tagname'     => 'source',
            'inline'      => false,
            'fqsen'       => "$method()",
            'description' => "this is description.",
            'location'    => [
                'path'  => __FILE__,
                'start' => $sline,
                'end'   => $eline,
            ],
        ]);
        $this->assertTag(@new Tag("@source NotFound this is description.", [], null, null, null), [
            'tagname'     => 'source',
            'inline'      => false,
            'fqsen'       => "NotFound",
            'description' => "this is description.",
            'location'    => null,
        ]);
    }

    function test_parseThrows()
    {
        $this->assertTag(new Tag('@throws ArrayObject[] this is description.', [], null, null, null), [
            'tagname'     => 'throws',
            'inline'      => false,
            'type'        => [
                'category' => 'class',
                'fqsen'    => '\\ArrayObject',
                'array'    => 1,
                'nullable' => false,
            ],
            'description' => 'this is description.',
        ]);
    }

    function test_parseTodo()
    {
        $this->assertTag(new Tag('@todo this is description.', [], null, null, null), [
            'tagname'     => 'todo',
            'inline'      => false,
            'description' => 'this is description.',
        ]);
    }

    function test_parseUses()
    {
        $this->assertTag(new Tag('@uses ArrayObject::method() this is description.', [], null, null, null), [
            'tagname'     => 'uses',
            'inline'      => false,
            'type'        => [
                'category' => 'method',
                'fqsen'    => '\\ArrayObject::method()',
                'array'    => 0,
                'nullable' => false,
            ],
            'description' => 'this is description.',
        ]);
    }

    function test_parseUsedBy()
    {
        $this->assertTag(new Tag('@used-by ArrayObject::method this is description.', [], null, null, null), [
            'tagname'     => 'used-by',
            'inline'      => false,
            'type'        => [
                'category' => 'method',
                'fqsen'    => '\\ArrayObject::method()',
                'array'    => 0,
                'nullable' => false,
            ],
            'description' => 'this is description.',
        ]);
    }

    function test_parseVar()
    {
        $this->assertTag(new Tag('@var ArrayObject[] $name this is description.', [], null, null, null), [
            'tagname'     => 'var',
            'inline'      => false,
            'name'        => '$name',
            'type'        => [
                [
                    'category' => 'class',
                    'fqsen'    => '\\ArrayObject',
                    'array'    => 1,
                    'nullable' => false,
                ],
            ],
            'description' => 'this is description.',
        ]);
        $this->assertTag(new Tag('@var ArrayObject[]|array $name', [], null, null, null), [
            'tagname'     => 'var',
            'inline'      => false,
            'name'        => '$name',
            'type'        => [
                [
                    'category' => 'class',
                    'fqsen'    => '\\ArrayObject',
                    'array'    => 1,
                    'nullable' => false,
                ],
                [
                    'category' => 'pseudo',
                    'fqsen'    => 'array',
                    'array'    => 0,
                    'nullable' => false,
                ],
            ],
            'description' => '',
        ]);
    }

    function test_parseVersion()
    {
        $this->assertTag(new Tag('@version 1.2.3 this is description.', [], null, null, null), [
            'tagname'     => 'version',
            'inline'      => false,
            'version'     => '1.2.3',
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@version', [], null, null, null), [
            'tagname'     => 'version',
            'inline'      => false,
            'version'     => '',
            'description' => '',
        ]);
    }
}
