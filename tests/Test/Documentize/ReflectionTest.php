<?php

namespace ryunosuke\Test\Documentize;

use NS\MagicClass;
use NS\MockClass;
use NS\MockInterface;
use NS\MockTrait;
use NS\PrototypeChildClass;
use NS\PrototypeInterface;
use NS\PrototypeParentClass;
use NS\PrototypeTrait;
use NS\StaticPropertyClass;
use NS\UndefinedPropertyClass;
use ryunosuke\Documentize\PhpFile;
use ryunosuke\Documentize\Reflection;

class ReflectionTest extends \ryunosuke\Test\AbstractUnitTestCase
{
    private $now;

    protected function setUp()
    {
        parent::setup();

        $this->now = time();
        touch(__DIR__ . '/_ReflectionTest/all.php', $this->now);
        PhpFile::cache(__DIR__ . '/_ReflectionTest/all.php');
        require_once __DIR__ . '/_ReflectionTest/all.php';
    }

    function test___construct()
    {
        $this->assertSame('constant', (new Reflection(['NS\\MockConstant' => 1]))->getCategory());
        $this->assertSame('class', (new Reflection(MockClass::class))->getCategory());
        $this->assertSame('classconstant', (new Reflection(MockClass::class . '::mockConstant'))->getCategory());
        $this->assertSame('property', (new Reflection(MockClass::class . '::$mockProperty'))->getCategory());
        $this->assertSame('method', (new Reflection(MockClass::class . '::mockMethod()'))->getCategory());
    }

    function test_constant()
    {
        $reflection = new Reflection(['NS\\MockConstant' => 1]);
        $this->assertSame('constant', $reflection->getCategory());
        $this->assertSame('NS\\MockConstant', $reflection->getFqsen());
        $this->assertSame('NS', $reflection->getNamespaceName());
        $this->assertSame('MockConstant', $reflection->getShortName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 5,
            'end'   => 5,
        ], $reflection->getLocation());
        $this->assertException(new \DomainException(), [$reflection, 'getFileName']);
        $this->assertException(new \DomainException(), [$reflection, 'getDocComment']);
        $this->assertSame(1, $reflection->getValue());
    }

    function test_function()
    {
        $reflection = new Reflection(new \ReflectionFunction('NS\\MockFunction'));
        $this->assertSame('function', $reflection->getCategory());
        $this->assertSame('NS\\MockFunction()', $reflection->getFqsen());
        $this->assertSame('NS', $reflection->getNamespaceName());
        $this->assertSame('MockFunction', $reflection->getShortName());
        $this->assertSame(realpath(__DIR__ . '/_ReflectionTest/all.php'), $reflection->getFileName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 7,
            'end'   => 8,
        ], $reflection->getLocation());
        $this->assertSame('/** funccomment */', $reflection->getDocComment());
        $this->assertSame($this->now, $reflection->getLastModified());
        $this->assertCount(3, $reflection->getParameters());
        $this->assertInstanceOf(\ReflectionType::class, $reflection->getType());
    }

    function test_interface()
    {
        $reflection = new Reflection(new \ReflectionClass(\NS\MockInterface::class));
        $this->assertSame('interface', $reflection->getCategory());
        $this->assertSame('NS\\MockInterface', $reflection->getFqsen());
        $this->assertSame('NS', $reflection->getNamespaceName());
        $this->assertSame('MockInterface', $reflection->getShortName());
        $this->assertSame(realpath(__DIR__ . '/_ReflectionTest/all.php'), $reflection->getFileName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 10,
            'end'   => 18,
        ], $reflection->getLocation());
        $this->assertSame('/** interfacecomment */', $reflection->getDocComment());
        $this->assertSame($this->now, $reflection->getLastModified());
        $this->assertSame([], $reflection->getParents());
        $this->assertSame([], $reflection->getImplements());
        $this->assertSame([], $reflection->getUses());
        $this->assertSame(false, $reflection->isFinal());
        $this->assertSame(true, $reflection->isAbstract());
        $this->assertSame(false, $reflection->isIterateable());
        $this->assertSame(true, $reflection->isInterface());
        $this->assertSame(false, $reflection->isTrait());
        $this->assertCount(0, $reflection->getTraitProperties());
        $this->assertCount(0, $reflection->getTraitMethods());
        $this->assertCount(1, $reflection->getConstants());
        $this->assertCount(0, $reflection->getProperties());
        $this->assertCount(1, $reflection->getMethods());
    }

    function test_trait()
    {
        $reflection = new Reflection(new \ReflectionClass(\NS\MockTrait::class));
        $this->assertSame('trait', $reflection->getCategory());
        $this->assertSame('NS\\MockTrait', $reflection->getFqsen());
        $this->assertSame('NS', $reflection->getNamespaceName());
        $this->assertSame('MockTrait', $reflection->getShortName());
        $this->assertSame(realpath(__DIR__ . '/_ReflectionTest/all.php'), $reflection->getFileName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 20,
            'end'   => 28,
        ], $reflection->getLocation());
        $this->assertSame('/** traitcomment */', $reflection->getDocComment());
        $this->assertSame($this->now, $reflection->getLastModified());
        $this->assertSame([], $reflection->getParents());
        $this->assertSame([], $reflection->getImplements());
        $this->assertSame([], $reflection->getUses());
        $this->assertSame(false, $reflection->isFinal());
        $this->assertSame(false, $reflection->isAbstract());
        $this->assertSame(false, $reflection->isIterateable());
        $this->assertSame(false, $reflection->isInterface());
        $this->assertSame(true, $reflection->isTrait());
        $this->assertCount(0, $reflection->getTraitProperties());
        $this->assertCount(0, $reflection->getTraitMethods());
        $this->assertCount(0, $reflection->getConstants());
        $this->assertCount(1, $reflection->getProperties());
        $this->assertCount(1, $reflection->getMethods());
    }

    function test_class()
    {
        $reflection = new Reflection(new \ReflectionClass(\NS\MockClass::class));
        $this->assertSame('class', $reflection->getCategory());
        $this->assertSame('NS\\MockClass', $reflection->getFqsen());
        $this->assertSame('NS', $reflection->getNamespaceName());
        $this->assertSame('MockClass', $reflection->getShortName());
        $this->assertSame(realpath(__DIR__ . '/_ReflectionTest/all.php'), $reflection->getFileName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 34,
            'end'   => 44,
        ], $reflection->getLocation());
        $this->assertSame('/** classcomment */', $reflection->getDocComment());
        $this->assertSame($this->now, $reflection->getLastModified());
        $this->assertSame(['NS\\MockParent'], $reflection->getParents());
        $this->assertSame(['NS\\MockInterface'], $reflection->getImplements());
        $this->assertSame(['NS\\MockTrait'], $reflection->getUses());
        $this->assertSame(false, $reflection->isFinal());
        $this->assertSame(false, $reflection->isAbstract());
        $this->assertSame(false, $reflection->isIterateable());
        $this->assertSame(false, $reflection->isInterface());
        $this->assertSame(false, $reflection->isTrait());
        $this->assertCount(1, $reflection->getTraitProperties());
        $this->assertCount(1, $reflection->getTraitMethods());
        $this->assertCount(1, $reflection->getConstants());
        $this->assertCount(1, $reflection->getProperties());
        $this->assertCount(1, $reflection->getMethods());
    }

    function test_classConstant()
    {
        $reflection = new Reflection(new \ReflectionClassConstant(MockClass::class, 'mockConstant'));
        $this->assertSame('classconstant', $reflection->getCategory());
        $this->assertSame('NS\\MockInterface::mockConstant', $reflection->getFqsen());
        $this->assertSame('NS\\MockInterface', $reflection->getNamespaceName());
        $this->assertSame('mockConstant', $reflection->getShortName());
        $this->assertSame(realpath(__DIR__ . '/_ReflectionTest/all.php'), $reflection->getFileName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 13,
            'end'   => 14,
        ], $reflection->getLocation());
        $this->assertSame('/** interfaceconstcomment */', $reflection->getDocComment());
        $this->assertSame(false, $reflection->isPrivate());
        $this->assertSame(false, $reflection->isProtected());
        $this->assertSame(true, $reflection->isPublic());
        $this->assertSame('public', $reflection->getAccessible());
        $this->assertEquals(null, $reflection->getProtoType());
        $this->assertEquals([], $reflection->getProtoTypes());
        $this->assertEquals(1, $reflection->getValue());
    }

    function test_property()
    {
        $reflection = new Reflection(new \ReflectionProperty(MockClass::class, 'mockProperty'));
        $this->assertSame('property', $reflection->getCategory());
        $this->assertSame('NS\\MockClass::$mockProperty', $reflection->getFqsen());
        $this->assertSame('NS\\MockClass', $reflection->getNamespaceName());
        $this->assertSame('mockProperty', $reflection->getShortName());
        $this->assertSame(realpath(__DIR__ . '/_ReflectionTest/all.php'), $reflection->getFileName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 39,
            'end'   => 40,
        ], $reflection->getLocation());
        $this->assertSame('/** classpropertycomment */', $reflection->getDocComment());
        $this->assertSame(false, $reflection->isPrivate());
        $this->assertSame(true, $reflection->isProtected());
        $this->assertSame(false, $reflection->isPublic());
        $this->assertSame('protected', $reflection->getAccessible());
        $this->assertEquals(new Reflection(new \ReflectionClass(MockClass::class)), $reflection->getDeclaringClass());
        $this->assertEquals(new Reflection(new \ReflectionProperty(MockTrait::class, 'mockProperty')), $reflection->getProtoType());
        $this->assertEquals([
            [
                'kind'  => 'override',
                'fqsen' => 'NS\\MockTrait::$mockProperty',
            ],
        ], $reflection->getProtoTypes());
        $this->assertEquals(1, $reflection->getValue());
    }

    function test_method()
    {
        $reflection = new Reflection(new \ReflectionMethod(MockClass::class, 'mockMethod'));
        $this->assertSame('method', $reflection->getCategory());
        $this->assertSame('NS\\MockClass::mockMethod()', $reflection->getFqsen());
        $this->assertSame('NS\\MockClass', $reflection->getNamespaceName());
        $this->assertSame('mockMethod', $reflection->getShortName());
        $this->assertSame(realpath(__DIR__ . '/_ReflectionTest/all.php'), $reflection->getFileName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 42,
            'end'   => 43,
        ], $reflection->getLocation());
        $this->assertSame('/** classmethodcomment */', $reflection->getDocComment());
        $this->assertSame(false, $reflection->isPrivate());
        $this->assertSame(false, $reflection->isProtected());
        $this->assertSame(true, $reflection->isPublic());
        $this->assertSame('public', $reflection->getAccessible());
        $this->assertEquals(new Reflection(new \ReflectionClass(MockClass::class)), $reflection->getDeclaringClass());
        $this->assertEquals(new Reflection(new \ReflectionMethod(MockInterface::class, 'mockMethod')), $reflection->getProtoType());
        $this->assertEquals([
            [
                'kind'  => 'implement',
                'fqsen' => 'NS\\MockInterface::mockMethod()',
            ],
            [
                'kind'  => 'instead',
                'fqsen' => 'NS\\MockTrait::mockMethod()',
            ],
        ], $reflection->getProtoTypes());
        $this->assertCount(0, $reflection->getParameters());
        $this->assertSame('NS\\MockClass', (string) $reflection->getType());
    }

    function test_parameter()
    {
        $reflection = new Reflection(new \ReflectionParameter('NS\\MockFunction', 0));
        $this->assertException(new \DomainException(), [$reflection, 'getCategory']);
        $this->assertException(new \DomainException(), [$reflection, 'getFqsen']);
        $this->assertException(new \DomainException(), [$reflection, 'getNamespaceName']);
        $this->assertSame('defc', $reflection->getShortName());
        $this->assertException(new \DomainException(), [$reflection, 'getFileName']);
        $this->assertException(new \DomainException(), [$reflection, 'getDocComment']);
        $this->assertException(new \DomainException(), [$reflection, 'getProtoType']);
        $this->assertException(new \DomainException(), [$reflection, 'getProtoTypes']);
        $this->assertInstanceOf(\ReflectionType::class, $reflection->getType());
        $this->assertSame('$defc = PHP_VERSION_ID', $reflection->getDeclaration());

        $reflection = new Reflection(new \ReflectionParameter('NS\\MockFunction', 1));
        $this->assertSame('$defa = [1, 2, 3]', $reflection->getDeclaration());

        $reflection = new Reflection(new \ReflectionParameter('NS\\MockFunction', 2));
        $this->assertSame('...$params', $reflection->getDeclaration());
    }

    function test_prototype()
    {
        $reflection = new Reflection(new \ReflectionClass(PrototypeParentClass::class));
        $this->assertEquals(null, $reflection->getProtoType());

        $reflection = new Reflection(new \ReflectionClass(PrototypeChildClass::class));

        $this->assertEquals('NS\\PrototypeParentClass', $reflection->getProtoType()->getFqsen());

        $constants = $reflection->getConstants();
        $this->assertEquals(null, $constants['interfaceConstant']->getProtoType());
        $this->assertEquals('NS\\PrototypeParentClass::parentConstant', $constants['parentConstant']->getProtoType()->getFqsen());
        $this->assertEquals(null, $constants['childConstant']->getProtoType());

        $properties = $reflection->getProperties();
        $this->assertEquals(null, $properties['parentProperty']->getProtoType());
        $this->assertEquals('NS\\PrototypeTrait::$traitProperty', $properties['traitProperty']->getProtoType()->getFqsen());
        $this->assertEquals('NS\\PrototypeParentClass::$overrideProperty', $properties['overrideProperty']->getProtoType()->getFqsen());
        $this->assertEquals(null, $reflection->getProperties()['childProperty']->getProtoType());

        $methods = $reflection->getMethods();
        $this->assertEquals(null, $methods['parentMethod']->getProtoType());
        $this->assertEquals('NS\\PrototypeInterface::interfaceMethod()', $methods['interfaceMethod']->getProtoType()->getFqsen());
        $this->assertEquals('NS\\PrototypeTrait::traitMethod()', $methods['traitMethod']->getProtoType()->getFqsen());
        $this->assertEquals('NS\\PrototypeParentClass::overrideMethod()', $methods['overrideMethod']->getProtoType()->getFqsen());
        $this->assertEquals('NS\\PrototypeParentClass::__construct()', $methods['__construct']->getProtoType()->getFqsen());
    }

    function test_prototypes()
    {
        $reflection = new Reflection(new \ReflectionClass(PrototypeChildClass::class));

        $constants = $reflection->getConstants();
        $this->assertEquals([
            [
                'kind'  => 'inherit',
                'fqsen' => 'NS\\PrototypeInterface::interfaceConstant',
            ],
        ], $constants['interfaceConstant']->getProtoTypes());
        $this->assertEquals([
            [
                'kind'  => 'override',
                'fqsen' => 'NS\\PrototypeParentClass::parentConstant',
            ],
        ], $constants['parentConstant']->getProtoTypes());
        $this->assertEquals([], $constants['childConstant']->getProtoTypes());

        $properties = $reflection->getProperties();
        $this->assertEquals([
            [
                'kind'  => 'inherit',
                'fqsen' => 'NS\\PrototypeParentClass::$parentProperty',
            ],
        ], $properties['parentProperty']->getProtoTypes());
        $this->assertEquals([
            [
                'kind'  => 'instead',
                'fqsen' => 'NS\\PrototypeTrait::$traitProperty',
            ],
        ], $properties['traitProperty']->getProtoTypes());
        $this->assertEquals([
            [
                'kind'  => 'override',
                'fqsen' => 'NS\\PrototypeParentClass::$overrideProperty',
            ],
        ], $properties['overrideProperty']->getProtoTypes());
        $this->assertEquals([], $properties['childProperty']->getProtoTypes());

        $methods = $reflection->getMethods();
        $this->assertEquals([
            [
                'kind'  => 'inherit',
                'fqsen' => 'NS\\PrototypeParentClass::parentMethod()',
            ],
        ], $methods['parentMethod']->getProtoTypes());
        $this->assertEquals([
            [
                'kind'  => 'implement',
                'fqsen' => 'NS\\PrototypeInterface::interfaceMethod()',
            ],
        ], $methods['interfaceMethod']->getProtoTypes());
        $this->assertEquals([
            [
                'kind'  => 'instead',
                'fqsen' => 'NS\\PrototypeTrait::traitMethod()',
            ],
        ], $methods['traitMethod']->getProtoTypes());
        $this->assertEquals([
            [
                'kind'  => 'override',
                'fqsen' => 'NS\\PrototypeParentClass::overrideMethod()',
            ],
        ], $methods['overrideMethod']->getProtoTypes());
    }

    function test_propertyValue()
    {
        $reflection = new Reflection(new \ReflectionProperty(StaticPropertyClass::class, 'staticProperty'));
        $this->assertEquals(1, $reflection->getValue());

        $reflection = new Reflection(new \ReflectionProperty(UndefinedPropertyClass::class, 'undefinedProperty'));
        $this->assertEquals(null, @$reflection->getValue());
    }

    function test_internal()
    {
        $reflection = (new Reflection(new \ReflectionClass(\Exception::class)));

        $this->assertSame('', $reflection->getNamespaceName());
        $this->assertSame('Exception', $reflection->getShortName());
        $this->assertSame('\\Exception', $reflection->getFqsen());

        $property = $reflection->getProperties()['file'];
        $this->assertSame('\\Exception', $property->getNamespaceName());
        $this->assertSame('file', $property->getShortName());
        $this->assertSame('\\Exception::$file', $property->getFqsen());

        $method = $reflection->getMethods()['getMessage'];
        $this->assertSame('\\Exception', $method->getNamespaceName());
        $this->assertSame('getMessage', $method->getShortName());
        $this->assertSame('\\Exception::getMessage()', $method->getFqsen());
    }

    function test_getMagicMethod()
    {
        $reflection = (new Reflection(new \ReflectionClass(MockClass::class)))->getMagicMethod('test', '', '$a, &$r, ...$v');
        $params = $reflection->getParameters();
        $this->assertSame('$a', $params['a']->getDeclaration());
        $this->assertSame('&$r', $params['r']->getDeclaration());
        $this->assertSame('...$v', $params['v']->getDeclaration());
    }

    function test_getMagicLocation()
    {
        $reflection = new Reflection(new \ReflectionClass(MagicClass::class));
        $this->assertArraySubset([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 108,
            'end'   => 108,
        ], $reflection->getMagicPropertyLocation('magicProperty'));
        $this->assertArraySubset([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 109,
            'end'   => 109,
        ], $reflection->getMagicMethodLocation('magicMethod'));
    }

    function test_getDeclaringClass()
    {
        $reflection = new Reflection(new \ReflectionClass(PrototypeChildClass::class));

        $constants = $reflection->getConstants();
        $this->assertEquals(new Reflection(PrototypeChildClass::class), $constants['parentConstant']->getDeclaringClass());
        $this->assertEquals(new Reflection(PrototypeChildClass::class), $constants['childConstant']->getDeclaringClass());
        $this->assertEquals(new Reflection(PrototypeInterface::class), $constants['interfaceConstant']->getDeclaringClass());

        $properties = $reflection->getProperties();
        $this->assertEquals(new Reflection(PrototypeChildClass::class), $properties['overrideProperty']->getDeclaringClass());
        $this->assertEquals(new Reflection(PrototypeChildClass::class), $properties['childProperty']->getDeclaringClass());
        $this->assertEquals(new Reflection(PrototypeParentClass::class), $properties['parentProperty']->getDeclaringClass());
        $this->assertEquals(new Reflection(PrototypeTrait::class), $properties['traitProperty']->getDeclaringClass());

        $methods = $reflection->getMethods();
        $this->assertEquals(new Reflection(PrototypeChildClass::class), $methods['interfaceMethod']->getDeclaringClass());
        $this->assertEquals(new Reflection(PrototypeChildClass::class), $methods['overrideMethod']->getDeclaringClass());
        $this->assertEquals(new Reflection(PrototypeChildClass::class), $methods['childMethod']->getDeclaringClass());
        $this->assertEquals(new Reflection(PrototypeParentClass::class), $methods['parentMethod']->getDeclaringClass());
        $this->assertEquals(new Reflection(PrototypeTrait::class), $methods['traitMethod']->getDeclaringClass());
    }

    function test_getLocation_misc()
    {
        eval('class abcdefg{const a=1;var $b;}');
        $reflection = (new Reflection(new \ReflectionClass('abcdefg')));
        $this->assertArraySubset([
            'start' => null,
            'end'   => null,
        ], $reflection->getConstants()['a']->getLocation());
        $this->assertArraySubset([
            'start' => null,
            'end'   => null,
        ], $reflection->getProperties()['b']->getLocation());
    }

    function test_misc()
    {
        $reflection = new Reflection(new \ReflectionType());
        $this->assertException(new \DomainException(), [$reflection, 'getCategory']);
        $this->assertException(new \DomainException(), [$reflection, 'getFqsen']);
        $this->assertException(new \DomainException(), [$reflection, 'getNamespaceName']);
        $this->assertException(new \DomainException(), [$reflection, 'getShortName']);
        $this->assertException(new \DomainException(), [$reflection, 'getFileName']);
        $this->assertException(new \DomainException(), [$reflection, 'getLocation'], '');
        $this->assertException(new \DomainException(), [$reflection, 'getDocComment']);
        $this->assertException(new \DomainException(), [$reflection, 'getLastModified']);
        $this->assertException(new \DomainException(), [$reflection, 'getDeclaringClass']);
        $this->assertException(new \DomainException(), [$reflection, 'getProtoType']);
        $this->assertException(new \DomainException(), [$reflection, 'getProtoTypes']);
        $this->assertException(new \DomainException(), [$reflection, 'getType']);
        $this->assertException(new \DomainException(), [$reflection, 'getValue']);
    }
}
