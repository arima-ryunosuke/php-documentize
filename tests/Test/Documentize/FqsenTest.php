<?php

namespace ryunosuke\Test\Documentize;

use ryunosuke\Documentize\Fqsen;

class FqsenTest extends \ryunosuke\Test\AbstractUnitTestCase
{
    const DUMMY_CONSTANT = 0;

    public $dummy_property;

    function dummy_method() { }

    function test_detectType()
    {
        eval('trait Traitable{}');
        $this->assertEquals('class', Fqsen::detectType('\\ArrayObject'));
        $this->assertEquals('class', Fqsen::detectType('ArrayObject'));
        $this->assertEquals('interface', Fqsen::detectType('\\Iterator'));
        $this->assertEquals('interface', Fqsen::detectType('Iterator'));
        $this->assertEquals('trait', Fqsen::detectType('\\Traitable'));
        $this->assertEquals('trait', Fqsen::detectType('Traitable'));
        $this->assertEquals(null, Fqsen::detectType('Hoge'));
        $this->assertEquals(null, Fqsen::detectType('123'));
        $this->assertEquals(null, Fqsen::detectType('Int'));
    }

    function test_parse()
    {
        $this->assertSame([
            'constant',
            '',
            'SORT_STRING',
            null,
        ], Fqsen::parse('SORT_STRING'));

        $this->assertSame([
            'function',
            '',
            'implode',
            null,
        ], Fqsen::parse('implode()'));

        $this->assertSame([
            'class',
            '',
            'ArrayObject',
            null,
        ], Fqsen::parse('\\ArrayObject'));

        $this->assertSame([
            'class',
            '',
            'ArrayObject',
            null,
        ], Fqsen::parse('\\ArrayObject'));

        $this->assertSame([
            'classconstant',
            '',
            'ArrayObject',
            'STD_PROP_LIST',
        ], Fqsen::parse('ArrayObject::STD_PROP_LIST'));

        $this->assertSame([
            'property',
            '',
            'ArrayObject',
            'propertyName',
        ], Fqsen::parse('ArrayObject::$propertyName'));

        $this->assertSame([
            'method',
            '',
            'ArrayObject',
            'methodName',
        ], Fqsen::parse('ArrayObject::methodName()'));

        $this->assertSame([
            'namespace',
            '\\vendor',
            'Type\\',
            null,
        ], Fqsen::parse('\\vendor\\Type\\'));

        $this->assertSame([
            'class',
            __NAMESPACE__,
            'FqsenTest',
            null,
        ], Fqsen::parse(__CLASS__));
    }

    function test_add()
    {
        $fqsen = new Fqsen('array');
        $fqsen->add(new Fqsen('bool'));
        $this->assertEquals([
            [
                'category' => 'pseudo',
                'fqsen'    => 'array',
                'array'    => 0,
            ],
            [
                'category' => 'pseudo',
                'fqsen'    => 'bool',
                'array'    => 0,
            ],
        ], $fqsen->resolve([], null, null));
    }

    function test_resolve_constant()
    {
        $fqsen = new Fqsen('SORT_STRING');
        $this->assertEquals([
            [
                'category' => 'constant',
                'fqsen'    => 'SORT_STRING',
                'array'    => 0,
            ]
        ], $fqsen->resolve([], __NAMESPACE__, null));

        $fqsen = new Fqsen('NULL');
        $this->assertEquals([
            [
                'category' => 'pseudo',
                'fqsen'    => 'NULL',
                'array'    => 0,
            ]
        ], $fqsen->resolve([], __NAMESPACE__, null));
    }

    function test_resolve_function()
    {
        $fqsen = new Fqsen('implode');
        $this->assertEquals([
            [
                'category' => 'function',
                'fqsen'    => 'implode()',
                'array'    => 0,
            ]
        ], $fqsen->resolve([], __NAMESPACE__, null));
    }

    function test_resolve_builtin()
    {
        $fqsen = new Fqsen('array');
        $this->assertEquals([
            [
                'category' => 'pseudo',
                'fqsen'    => 'array',
                'array'    => 0,
            ]
        ], $fqsen->resolve([__NAMESPACE__ => ['Hoge' => __CLASS__]], __NAMESPACE__, '\\vendor\\MyClass'));
    }

    function test_resolve_member()
    {
        $fqsen = new Fqsen();
        $fqsen->add(__CLASS__ . '::DUMMY_CONSTANT');
        $fqsen->add(__CLASS__ . '::$dummy_property');
        $fqsen->add(__CLASS__ . '::dummy_method');
        $this->assertEquals([
            [
                'category' => 'classconstant',
                'fqsen'    => 'ryunosuke\Test\Documentize\FqsenTest::DUMMY_CONSTANT',
                'array'    => 0,
            ],
            [
                'category' => 'property',
                'fqsen'    => 'ryunosuke\Test\Documentize\FqsenTest::$dummy_property',
                'array'    => 0,
            ],
            [
                'category' => 'method',
                'fqsen'    => 'ryunosuke\Test\Documentize\FqsenTest::dummy_method()',
                'array'    => 0,
            ],
        ], $fqsen->resolve([__NAMESPACE__ => ['Hoge' => __CLASS__]], __NAMESPACE__, '\\vendor\\MyClass'));
    }

    function test_resolve_self()
    {
        $fqsen = new Fqsen('$this');
        $this->assertEquals([
            [
                'category' => 'type',
                'fqsen'    => '\\vendor\\MyClass',
                'array'    => 0,
            ]
        ], $fqsen->resolve([__NAMESPACE__ => ['Hoge' => __CLASS__]], __NAMESPACE__, '\\vendor\\MyClass'));
    }

    function test_resolve_self_method()
    {
        $fqsen = new Fqsen('$this::method');
        $this->assertEquals([
            [
                'category' => 'method',
                'fqsen'    => '\\vendor\\MyClass::method()',
                'array'    => 0,
            ]
        ], $fqsen->resolve([__NAMESPACE__ => ['Hoge' => __CLASS__]], __NAMESPACE__, '\\vendor\\MyClass'));
    }

    function test_resolve_using()
    {
        $fqsen = new Fqsen('Hoge');
        $this->assertEquals([
            [
                'category' => 'class',
                'fqsen'    => __NAMESPACE__ . '\\FqsenTest',
                'array'    => 0,
            ]
        ], $fqsen->resolve([__NAMESPACE__ => ['Hoge' => __CLASS__]], __NAMESPACE__, '\\vendor\\MyClass'));
    }

    function test_resolve_using_property()
    {
        $fqsen = new Fqsen('Hoge::$property');
        $this->assertEquals([
            [
                'category' => 'property',
                'fqsen'    => __NAMESPACE__ . '\\FqsenTest::$property',
                'array'    => 0,
            ]
        ], $fqsen->resolve([__NAMESPACE__ => ['Hoge' => __CLASS__]], __NAMESPACE__, '\\vendor\\MyClass'));
    }

    function test_resolve_full()
    {
        $fqsen = new Fqsen('\\' . __CLASS__);
        $this->assertEquals([
            [
                'category' => 'class',
                'fqsen'    => __CLASS__,
                'array'    => 0,
            ]
        ], $fqsen->resolve([__NAMESPACE__ => ['Hoge' => __CLASS__]], __NAMESPACE__, '\\vendor\\MyClass'));
    }

    function test_resolve_other()
    {
        $fqsen = new Fqsen('Sub\\FqsenTest');
        $this->assertEquals([
            [
                'category' => 'class',
                'fqsen'    => __CLASS__,
                'array'    => 0,
            ]
        ], $fqsen->resolve([__NAMESPACE__ => ['Sub' => __NAMESPACE__]], __NAMESPACE__, '\\vendor\\MyClass'));
    }

    function test_resolve_array()
    {
        $fqsen = new Fqsen(__CLASS__ . '[][]');
        $this->assertEquals([
            [
                'category' => 'class',
                'fqsen'    => __CLASS__,
                'array'    => 2,
            ]
        ], $fqsen->resolve([__NAMESPACE__ => ['Hoge' => __CLASS__]], __NAMESPACE__, '\\vendor\\MyClass'));
    }

    function test_resolve_subspace()
    {
        $parts = explode('\\', __NAMESPACE__);
        $sub = array_pop($parts);
        $fqsen = new Fqsen("$sub\\FqsenTest");
        $this->assertEquals([
            [
                'category' => 'class',
                'fqsen'    => __CLASS__,
                'array'    => 0,
            ]
        ], $fqsen->resolve([__NAMESPACE__ => [$sub => __NAMESPACE__]], __NAMESPACE__, '\\vendor\\MyClass'));
    }

    function test_resolve_middlename()
    {
        $parts = explode('\\', __NAMESPACE__);
        $sub = array_pop($parts);
        $fqsen = new Fqsen("$sub\\FqsenTest");
        $this->assertEquals([
            [
                'category' => 'class',
                'fqsen'    => __CLASS__,
                'array'    => 0,
            ]
        ], $fqsen->resolve([__NAMESPACE__ => []], 'ryunosuke\\Test', '\\vendor\\MyClass'));
    }

    function test_resolve_fullname()
    {
        $fqsen = new Fqsen(__CLASS__);
        $this->assertEquals([
            [
                'category' => 'class',
                'fqsen'    => __CLASS__,
                'array'    => 0,
            ]
        ], $fqsen->resolve([], __NAMESPACE__, null));
    }
}
