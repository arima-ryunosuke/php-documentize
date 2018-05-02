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
        $this->assertTag(new Tag('@version 1.2.3', [], null, null), [
            'tagname'     => 'version',
            'inline'      => false,
            'version'     => '1.2.3',
            'description' => '',
        ]);

        $this->assertTag(new Tag('{@version 1.2.3 description}', [], null, null), [
            'tagname'     => 'version',
            'inline'      => true,
            'version'     => '1.2.3',
            'description' => 'description',
        ]);

        $this->assertTag(new Tag('@hoge', [], null, null), [
            'tagname' => 'hoge',
            'inline'  => false,
        ]);

        $this->assertTag(new Tag('{@hoge}', [], null, null), [
            'tagname' => 'hoge',
            'inline'  => true,
        ]);
    }

    function test_getInlineText()
    {
        // インラインでなければ null
        $tag = new Tag('@todo noinline', [], null, null);
        $this->assertSame(null, $tag->getInlineText());

        // インラインならタグ化される
        $tag = new Tag('{@todo noinline}', [], null, null);
        $this->assertEquals("<tag-todo data-description='noinline' />", $tag->getInlineText());

        // inheritdoc だけは特別扱い
        $tag = new Tag('{@inheritdoc noinline}', [], null, null);
        $this->assertEquals("HereIsInheritdoc<tag-inheritdoc data-type-category='type' data-type-fqsen='noinline' data-type-array='0' />", $tag->getInlineText());
    }

    function test_parseApi()
    {
        $this->assertTag(new Tag('@api', [], null, null), [
            'tagname' => 'api',
            'inline'  => false,
        ]);
    }

    function test_parseAuthor()
    {
        $this->assertTag(new Tag('@author this is name <this@is.email>', [], null, null), [
            'tagname' => 'author',
            'inline'  => false,
            'name'    => 'this is name',
            'email'   => '<this@is.email>',
        ]);

        $this->assertTag(new Tag('@author this is name', [], null, null), [
            'tagname' => 'author',
            'inline'  => false,
            'name'    => 'this is name',
            'email'   => '',
        ]);
    }

    function test_parseCopyright()
    {
        $this->assertTag(new Tag('@copyright this is description.', [], null, null), [
            'tagname'     => 'copyright',
            'inline'      => false,
            'description' => 'this is description.',
        ]);
    }

    function test_parseDeprecated()
    {
        $this->assertTag(new Tag('@deprecated 1.0.0:2.0.0 this is description.', [], null, null), [
            'tagname'     => 'deprecated',
            'inline'      => false,
            'start'       => '1.0.0',
            'end'         => '2.0.0',
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@deprecated 1.0.0:2.0.0', [], null, null), [
            'tagname'     => 'deprecated',
            'inline'      => false,
            'start'       => '1.0.0',
            'end'         => '2.0.0',
            'description' => '',
        ]);

        $this->assertTag(new Tag('@deprecated 1.0.0', [], null, null), [
            'tagname'     => 'deprecated',
            'inline'      => false,
            'start'       => '1.0.0',
            'end'         => '',
            'description' => '',
        ]);

        $this->assertTag(new Tag('@deprecated :2.0.0', [], null, null), [
            'tagname'     => 'deprecated',
            'inline'      => false,
            'start'       => '',
            'end'         => '2.0.0',
            'description' => '',
        ]);
    }

    function test_parseExample()
    {
        $this->assertTag(new Tag('@example http://example.com this is description.', [], null, null), [
            'tagname'     => 'example',
            'inline'      => false,
            'uri'         => 'http://example.com',
            'description' => 'this is description.',
        ]);
    }

    function test_parseIgnore()
    {
        $this->assertTag(new Tag('@ignore', [], null, null), [
            'tagname' => 'ignore',
            'inline'  => false,
        ]);
    }

    function test_parseInheritdoc()
    {
        $this->assertTag(new Tag('@inheritdoc', [], null, null), [
            'tagname' => 'inheritdoc',
            'inline'  => false,
            'type'    => null,
        ]);

        $this->assertTag(new Tag('@inheritdoc \\vendor\\Type', [], null, null), [
            'tagname' => 'inheritdoc',
            'inline'  => false,
            'type'    => [
                'category' => 'type',
                'fqsen'    => '\\vendor\\Type',
                'array'    => 0,
            ],
        ]);

        $this->assertTag(new Tag('@inheritdoc \\vendor\\Type::method()', [], null, null), [
            'tagname' => 'inheritdoc',
            'inline'  => false,
            'type'    => [
                'category' => 'method',
                'fqsen'    => '\\vendor\\Type::method()',
                'array'    => 0,
            ],
        ]);
    }

    function test_parseInternal()
    {
        $this->assertTag(new Tag('@internal this is description.', [], null, null), [
            'tagname'     => 'internal',
            'inline'      => false,
            'description' => 'this is description.',
        ]);
    }

    function test_parseLicense()
    {
        $this->assertTag(new Tag('@license http://example.com this is description.', [], null, null), [
            'tagname'     => 'license',
            'inline'      => false,
            'type'        => 'uri',
            'value'       => 'http://example.com',
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@license MIT', [], null, null), [
            'tagname'     => 'license',
            'inline'      => false,
            'type'        => 'spdx',
            'value'       => 'MIT',
            'description' => '',
        ]);
    }

    function test_parseLink()
    {
        $this->assertTag(new Tag('@link \\vendor\\Type[] this is description.', [], null, null), [
            'tagname'     => 'link',
            'inline'      => false,
            'kind'        => 'fqsen',
            'type'        => [
                'category' => 'type',
                'fqsen'    => '\\vendor\\Type',
                'array'    => 1,
            ],
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@link http://example.com this is description.', [], null, null), [
            'tagname'     => 'link',
            'inline'      => false,
            'kind'        => 'uri',
            'type'        => 'http://example.com',
            'description' => 'this is description.',
        ]);
    }

    function test_parseMethod()
    {
        $this->assertTag(new Tag('@method sityaka metyaka', [], null, null), [
            'tagname' => 'method',
            'inline'  => false,
        ]);

        $this->assertTag(new Tag('@method sityaka name((((( description', [], null, null), [
            'tagname' => 'method',
            'inline'  => false,
        ]);

        $this->assertTag(new Tag('@method \\vendor\\Type methodName($arg1, &$arg2, ...$args) this is description.', [], null, null), [
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
 * @return \\vendor\\Type
 */
',
        ]);

        $this->assertTag(new Tag('@method \\vendor\\Type methodName(int|string $multitype, $arg1 = array(), $arg2 = ["1, 2", 3]) this is description (brace).', [], null, null), [
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
 * @return \\vendor\\Type
 */
',
        ]);

        $this->assertTag(new Tag('@method \\vendor\\Type methodName(int|string $multitype, Type &$refdef = null)', [], null, null), [
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
 * @return \\vendor\\Type
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
}', [], null, null), [
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

        $this->assertTag(new Tag('@method static \\vendor\\Type methodName(int|string $multitype, Type &$refdef = null) {
    description
}', [], null, null), [
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
 * @return \\vendor\\Type
 */
',
        ]);

        $this->assertTag(new Tag('@method \\vendor\\Type methodName($arg1, &$arg2, ...$args) {
    this is description.
    
    this is description.
    
    @param string $arg1 arg1 is ...
    @param string $arg2 arg2 is ...
    @param array $args args are ...
}', [], null, null), [
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
 * @return \\vendor\\Type
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
}', [], null, null), [
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
 * @param mixed 
 * @return void
 */
',
        ]);
    }

    function test_parseParam()
    {
        $this->assertTag(new Tag('@param \\vendor\\Type[] $name this is description.', [], null, null), [
            'tagname'     => 'param',
            'inline'      => false,
            'name'        => 'name',
            'type'        => [
                [
                    'category' => 'type',
                    'fqsen'    => '\\vendor\\Type',
                    'array'    => 1,
                ],
            ],
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@param \\vendor\\Type[]|array $name', [], null, null), [
            'tagname'     => 'param',
            'inline'      => false,
            'name'        => 'name',
            'type'        => [
                [
                    'category' => 'type',
                    'fqsen'    => '\\vendor\\Type',
                    'array'    => 1,
                ],
                [
                    'category' => 'pseudo',
                    'fqsen'    => 'array',
                    'array'    => 0,
                ],
            ],
            'description' => '',
        ]);
    }

    function test_parseProperty()
    {
        $this->assertTag(new Tag('@property sityaka metyaka', [], null, null), [
            'tagname' => 'property',
            'inline'  => false,
        ]);

        $this->assertTag(new Tag('@property \\vendor\\Type[] $name this is description.', [], null, null), [
            'tagname'    => 'property',
            'inline'     => false,
            'name'       => 'name',
            'static'     => false,
            'doccomment' => '/**
 * this is description.
 * 
 * @var \vendor\Type[]
 */
',
        ]);

        $this->assertTag(new Tag('@property static \\vendor\\Type[]|array $name', [], null, null), [
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

        $this->assertTag(new Tag('@property \\vendor\\Type[] $name {
    description
}', [], null, null), [
            'tagname'    => 'property',
            'inline'     => false,
            'name'       => 'name',
            'static'     => false,
            'doccomment' => '/**
 * description
 * 
 * @var \vendor\Type[]
 */
',
        ]);
    }

    function test_parseReturn()
    {
        $this->assertTag(new Tag('@return \\vendor\\Type[] this is description.', [], null, null), [
            'tagname'     => 'return',
            'inline'      => false,
            'type'        => [
                [
                    'category' => 'type',
                    'fqsen'    => '\\vendor\\Type',
                    'array'    => 1,
                ]
            ],
            'description' => 'this is description.',
        ]);
    }

    function test_parseSee()
    {
        $this->assertTag(new Tag('@see \\vendor\\Type[] this is description.', [], null, null), [
            'tagname'     => 'see',
            'inline'      => false,
            'kind'        => 'fqsen',
            'type'        => [
                'category' => 'type',
                'fqsen'    => '\\vendor\\Type',
                'array'    => 1,
            ],
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@see http://example.com this is description.', [], null, null), [
            'tagname'     => 'see',
            'inline'      => false,
            'kind'        => 'uri',
            'type'        => 'http://example.com',
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@see $property', [], null, 'ClassName'), [
            'tagname'     => 'see',
            'inline'      => false,
            'kind'        => 'fqsen',
            'type'        => [
                'category' => 'property',
                'fqsen'    => 'ClassName::$property',
                'array'    => 0,
            ],
            'description' => '',
        ]);

        $this->assertTag(new Tag('@see method()', [], null, 'ClassName'), [
            'tagname'     => 'see',
            'inline'      => false,
            'kind'        => 'fqsen',
            'type'        => [
                'category' => 'method',
                'fqsen'    => 'ClassName::method()',
                'array'    => 0,
            ],
            'description' => '',
        ]);
    }

    function test_parseSince()
    {
        $this->assertTag(new Tag('@since 1.2.3 this is description.', [], null, null), [
            'tagname'     => 'since',
            'inline'      => false,
            'version'     => '1.2.3',
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@since', [], null, null), [
            'tagname'     => 'since',
            'inline'      => false,
            'version'     => '',
            'description' => '',
        ]);
    }

    function test_parseThrows()
    {
        $this->assertTag(new Tag('@throws \\vendor\\Type[] this is description.', [], null, null), [
            'tagname'     => 'throws',
            'inline'      => false,
            'type'        => [
                'category' => 'type',
                'fqsen'    => '\\vendor\\Type',
                'array'    => 1,
            ],
            'description' => 'this is description.',
        ]);
    }

    function test_parseTodo()
    {
        $this->assertTag(new Tag('@todo this is description.', [], null, null), [
            'tagname'     => 'todo',
            'inline'      => false,
            'description' => 'this is description.',
        ]);
    }

    function test_parseUses()
    {
        $this->assertTag(new Tag('@uses \\vendor\\Type::method() this is description.', [], null, null), [
            'tagname'     => 'uses',
            'inline'      => false,
            'type'        => [
                'category' => 'method',
                'fqsen'    => '\\vendor\\Type::method()',
                'array'    => 0,
            ],
            'description' => 'this is description.',
        ]);
    }

    function test_parseUsedBy()
    {
        $this->assertTag(new Tag('@used-by \\vendor\\Type::method this is description.', [], null, null), [
            'tagname'     => 'used-by',
            'inline'      => false,
            'type'        => [
                'category' => 'method',
                'fqsen'    => '\\vendor\\Type::method()',
                'array'    => 0,
            ],
            'description' => 'this is description.',
        ]);
    }

    function test_parseVar()
    {
        $this->assertTag(new Tag('@var \\vendor\\Type[] $name this is description.', [], null, null), [
            'tagname'     => 'var',
            'inline'      => false,
            'name'        => '$name',
            'type'        => [
                [
                    'category' => 'type',
                    'fqsen'    => '\\vendor\\Type',
                    'array'    => 1,
                ],
            ],
            'description' => 'this is description.',
        ]);
        $this->assertTag(new Tag('@var \\vendor\\Type[]|array $name', [], null, null), [
            'tagname'     => 'var',
            'inline'      => false,
            'name'        => '$name',
            'type'        => [
                [
                    'category' => 'type',
                    'fqsen'    => '\\vendor\\Type',
                    'array'    => 1,
                ],
                [
                    'category' => 'pseudo',
                    'fqsen'    => 'array',
                    'array'    => 0,
                ],
            ],
            'description' => '',
        ]);
    }

    function test_parseVersion()
    {
        $this->assertTag(new Tag('@version 1.2.3 this is description.', [], null, null), [
            'tagname'     => 'version',
            'inline'      => false,
            'version'     => '1.2.3',
            'description' => 'this is description.',
        ]);

        $this->assertTag(new Tag('@version', [], null, null), [
            'tagname'     => 'version',
            'inline'      => false,
            'version'     => '',
            'description' => '',
        ]);
    }
}
