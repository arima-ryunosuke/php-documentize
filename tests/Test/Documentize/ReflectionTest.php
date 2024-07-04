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
use NS\TypedClass;
use NS\UndefinedPropertyClass;
use ryunosuke\Documentize\PhpFile;
use ryunosuke\Documentize\Reflection;
use function ryunosuke\Documentize\array_pickup;

class ReflectionTest extends \ryunosuke\Test\AbstractUnitTestCase
{
    private $now;

    protected function setUp(): void
    {
        parent::setup();

        $this->now = time();
        touch(__DIR__ . '/_ReflectionTest/all.php', $this->now);
        PhpFile::cache(__DIR__ . '/_ReflectionTest/all.php');
        require_once __DIR__ . '/_ReflectionTest/all.php';
    }

    function test___construct()
    {
        $this->assertSame('constant', (Reflection::instance(['NS\\MockConstant' => 1]))->getCategory());
        $this->assertSame('class', (Reflection::instance(MockClass::class))->getCategory());
        $this->assertSame('classconstant', (Reflection::instance(MockClass::class . '::mockConstant'))->getCategory());
        $this->assertSame('property', (Reflection::instance(MockClass::class . '::$mockProperty'))->getCategory());
        $this->assertSame('method', (Reflection::instance(MockClass::class . '::mockMethod()'))->getCategory());
    }

    function test_constant()
    {
        $reflection = Reflection::instance(['NS\\MockConstant' => 1]);
        $this->assertSame('constant', $reflection->getCategory());
        $this->assertSame('NS\\MockConstant', $reflection->getFqsen());
        $this->assertSame('NS', $reflection->getNamespaceName());
        $this->assertSame('MockConstant', $reflection->getShortName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 6,
            'end'   => 6,
        ], $reflection->getLocation());
        $this->assertSame('/** constcomment */', $reflection->getDocComment());
        $this->assertSame(1, $reflection->getValue());
    }

    function test_function()
    {
        $reflection = Reflection::instance('NS\\MockFunction()');
        $this->assertSame('function', $reflection->getCategory());
        $this->assertSame('NS\\MockFunction()', $reflection->getFqsen());
        $this->assertSame('NS', $reflection->getNamespaceName());
        $this->assertSame('MockFunction', $reflection->getShortName());
        $this->assertSame(realpath(__DIR__ . '/_ReflectionTest/all.php'), $reflection->getFileName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 8,
            'end'   => 9,
        ], $reflection->getLocation());
        $this->assertSame('/** funccomment */', $reflection->getDocComment());
        $this->assertSame($this->now, $reflection->getLastModified());
        $this->assertCount(3, $reflection->getParameters());
        $this->assertSame('int', $reflection->getType()->getFqsen());
    }

    function test_interface()
    {
        $reflection = Reflection::instance(\NS\MockInterface::class);
        $this->assertSame('interface', $reflection->getCategory());
        $this->assertSame('NS\\MockInterface', $reflection->getFqsen());
        $this->assertSame('NS', $reflection->getNamespaceName());
        $this->assertSame('MockInterface', $reflection->getShortName());
        $this->assertSame(realpath(__DIR__ . '/_ReflectionTest/all.php'), $reflection->getFileName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 11,
            'end'   => 19,
        ], $reflection->getLocation());
        $this->assertSame('/** interfacecomment */', $reflection->getDocComment());
        $this->assertSame($this->now, $reflection->getLastModified());
        $this->assertSame([], $reflection->getParents());
        $this->assertSame([], $reflection->getImplements());
        $this->assertSame([], $reflection->getUses());
        $this->assertSame(false, $reflection->isFinal());
        $this->assertSame(true, $reflection->isAbstract());
        $this->assertSame(false, $reflection->isIterable());
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
        $reflection = Reflection::instance(\NS\MockTrait::class);
        $this->assertSame('trait', $reflection->getCategory());
        $this->assertSame('NS\\MockTrait', $reflection->getFqsen());
        $this->assertSame('NS', $reflection->getNamespaceName());
        $this->assertSame('MockTrait', $reflection->getShortName());
        $this->assertSame(realpath(__DIR__ . '/_ReflectionTest/all.php'), $reflection->getFileName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 21,
            'end'   => 29,
        ], $reflection->getLocation());
        $this->assertSame('/** traitcomment */', $reflection->getDocComment());
        $this->assertSame($this->now, $reflection->getLastModified());
        $this->assertSame([], $reflection->getParents());
        $this->assertSame([], $reflection->getImplements());
        $this->assertSame([], $reflection->getUses());
        $this->assertSame(false, $reflection->isFinal());
        $this->assertSame(false, $reflection->isAbstract());
        $this->assertSame(false, $reflection->isIterable());
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
        $reflection = Reflection::instance(\NS\MockClass::class);
        $this->assertSame('class', $reflection->getCategory());
        $this->assertSame('NS\\MockClass', $reflection->getFqsen());
        $this->assertSame('NS', $reflection->getNamespaceName());
        $this->assertSame('MockClass', $reflection->getShortName());
        $this->assertSame(realpath(__DIR__ . '/_ReflectionTest/all.php'), $reflection->getFileName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 35,
            'end'   => 45,
        ], $reflection->getLocation());
        $this->assertSame('/** classcomment */', $reflection->getDocComment());
        $this->assertSame($this->now, $reflection->getLastModified());
        $this->assertSame(['NS\\MockParent'], $reflection->getParents());
        $this->assertSame(['NS\\MockInterface'], $reflection->getImplements());
        $this->assertSame(['NS\\MockTrait'], $reflection->getUses());
        $this->assertSame(false, $reflection->isFinal());
        $this->assertSame(false, $reflection->isAbstract());
        $this->assertSame(false, $reflection->isIterable());
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
        $reflection = Reflection::instance(MockClass::class . '::mockConstant');
        $this->assertSame('classconstant', $reflection->getCategory());
        $this->assertSame('NS\\MockInterface::mockConstant', $reflection->getFqsen());
        $this->assertSame('NS\\MockInterface', $reflection->getNamespaceName());
        $this->assertSame('mockConstant', $reflection->getShortName());
        $this->assertSame(realpath(__DIR__ . '/_ReflectionTest/all.php'), $reflection->getFileName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 14,
            'end'   => 15,
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
        $reflection = Reflection::instance(MockClass::class . '::$mockProperty');
        $this->assertSame('property', $reflection->getCategory());
        $this->assertSame('NS\\MockClass::$mockProperty', $reflection->getFqsen());
        $this->assertSame('NS\\MockClass', $reflection->getNamespaceName());
        $this->assertSame('mockProperty', $reflection->getShortName());
        $this->assertSame(realpath(__DIR__ . '/_ReflectionTest/all.php'), $reflection->getFileName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 40,
            'end'   => 41,
        ], $reflection->getLocation());
        $this->assertSame('/** classpropertycomment */', $reflection->getDocComment());
        $this->assertSame(false, $reflection->isPrivate());
        $this->assertSame(true, $reflection->isProtected());
        $this->assertSame(false, $reflection->isPublic());
        $this->assertSame('protected', $reflection->getAccessible());
        $this->assertEquals(Reflection::instance(MockClass::class), $reflection->getDeclaringClass());
        $this->assertEquals(Reflection::instance(MockTrait::class . '::$mockProperty'), $reflection->getProtoType());
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
        $reflection = Reflection::instance(MockClass::class . '::mockMethod()');
        $this->assertSame('method', $reflection->getCategory());
        $this->assertSame('NS\\MockClass::mockMethod()', $reflection->getFqsen());
        $this->assertSame('NS\\MockClass', $reflection->getNamespaceName());
        $this->assertSame('mockMethod', $reflection->getShortName());
        $this->assertSame(realpath(__DIR__ . '/_ReflectionTest/all.php'), $reflection->getFileName());
        $this->assertSame([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 43,
            'end'   => 44,
        ], $reflection->getLocation());
        $this->assertSame('/** classmethodcomment */', $reflection->getDocComment());
        $this->assertSame(false, $reflection->isPrivate());
        $this->assertSame(false, $reflection->isProtected());
        $this->assertSame(true, $reflection->isPublic());
        $this->assertSame('public', $reflection->getAccessible());
        $this->assertEquals(Reflection::instance(MockClass::class), $reflection->getDeclaringClass());
        $this->assertEquals(Reflection::instance(MockInterface::class . '::mockMethod()'), $reflection->getProtoType());
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
        $this->assertSame('NS\\MockClass', $reflection->getType()->getFqsen());
    }

    function test_parameter()
    {
        $reffunc = Reflection::instance('NS\\MockFunction()');

        $reflection = $reffunc->getParameters()['defc'];
        $this->assertException(new \DomainException(), [$reflection, 'getCategory']);
        $this->assertException(new \DomainException(), [$reflection, 'getFqsen']);
        $this->assertException(new \DomainException(), [$reflection, 'getNamespaceName']);
        $this->assertSame('defc', $reflection->getShortName());
        $this->assertException(new \DomainException(), [$reflection, 'getFileName']);
        $this->assertException(new \DomainException(), [$reflection, 'getDocComment']);
        $this->assertException(new \DomainException(), [$reflection, 'getProtoType']);
        $this->assertException(new \DomainException(), [$reflection, 'getProtoTypes']);
        $this->assertSame('int', $reflection->getType()->getFqsen());
        $this->assertSame('$defc = PHP_VERSION_ID', $reflection->getDeclaration());

        $reflection = $reffunc->getParameters()['defa'];
        $this->assertSame('$defa = [1, 2, 3]', $reflection->getDeclaration());

        $reflection = $reffunc->getParameters()['params'];
        $this->assertSame('&...$params', $reflection->getDeclaration());
    }

    function test_prototype()
    {
        $reflection = Reflection::instance(PrototypeParentClass::class);
        $this->assertEquals(null, $reflection->getProtoType());

        $reflection = Reflection::instance(PrototypeChildClass::class);

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
        $reflection = Reflection::instance(PrototypeChildClass::class);

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
        $reflection = Reflection::instance(StaticPropertyClass::class . '::$staticProperty');
        $this->assertEquals(1, $reflection->getValue());

        $reflection = Reflection::instance(UndefinedPropertyClass::class . '::$undefinedProperty');
        $this->assertEquals(null, @$reflection->getValue());

        $reflection = Reflection::instance(TypedClass::class . '::$nodefaultStaticProperty');
        $this->assertEquals(null, $reflection->getValue());

        $reflection = Reflection::instance(TypedClass::class . '::$nodefaultProperty');
        $this->assertEquals(null, $reflection->getValue());
    }

    function test_internal()
    {
        $reflection = (Reflection::instance(\Exception::class));

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

    function test_type()
    {
        $reflection = (Reflection::instance(TypedClass::class));

        $property = $reflection->getProperties()['nodefaultStaticProperty'];
        $this->assertSame(false, $property->hasValue());

        $property = $reflection->getProperties()['nodefaultProperty'];
        $this->assertSame(false, $property->hasValue());

        $property = $reflection->getProperties()['typedProperty'];
        $this->assertSame(true, $property->hasValue());
        $this->assertSame('?array', $property->getType()->getFqsen());

        $method = $reflection->getMethods()['typedMethod'];
        $this->assertSame('?string', $method->getType()->getFqsen());
        $this->assertSame('?array', $method->getParameters()['arg1']->getType()->getFqsen());

        $reflection = Reflection::instance(UndefinedPropertyClass::class . '::$nodefaultProperty');
        $this->assertEquals(true, @$reflection->hasValue());
    }

    function test_getMagicMethod()
    {
        $reflection = (Reflection::instance(MockClass::class))->getMagicMethod('test', '', '$a, &$r, ...$v');
        $params = $reflection->getParameters();
        $this->assertSame('$a', $params['a']->getDeclaration());
        $this->assertSame('&$r', $params['r']->getDeclaration());
        $this->assertSame('...$v', $params['v']->getDeclaration());
    }

    function test_getMagicLocation()
    {
        $reflection = Reflection::instance(MagicClass::class);
        $this->assertEquals([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 122,
            'end'   => 122,
        ], $reflection->getMagicPropertyLocation('magicProperty'));
        $this->assertEquals([
            'path'  => realpath(__DIR__ . '/_ReflectionTest/all.php'),
            'start' => 123,
            'end'   => 123,
        ], $reflection->getMagicMethodLocation('magicMethod'));
    }

    function test_getDeclaringClass()
    {
        $reflection = Reflection::instance(PrototypeChildClass::class);

        $constants = $reflection->getConstants();
        $this->assertEquals(Reflection::instance(PrototypeChildClass::class), $constants['parentConstant']->getDeclaringClass());
        $this->assertEquals(Reflection::instance(PrototypeChildClass::class), $constants['childConstant']->getDeclaringClass());
        $this->assertEquals(Reflection::instance(PrototypeInterface::class), $constants['interfaceConstant']->getDeclaringClass());

        $properties = $reflection->getProperties();
        $this->assertEquals(Reflection::instance(PrototypeChildClass::class), $properties['overrideProperty']->getDeclaringClass());
        $this->assertEquals(Reflection::instance(PrototypeChildClass::class), $properties['childProperty']->getDeclaringClass());
        $this->assertEquals(Reflection::instance(PrototypeParentClass::class), $properties['parentProperty']->getDeclaringClass());
        $this->assertEquals(Reflection::instance(PrototypeTrait::class), $properties['traitProperty']->getDeclaringClass());

        $methods = $reflection->getMethods();
        $this->assertEquals(Reflection::instance(PrototypeChildClass::class), $methods['interfaceMethod']->getDeclaringClass());
        $this->assertEquals(Reflection::instance(PrototypeChildClass::class), $methods['overrideMethod']->getDeclaringClass());
        $this->assertEquals(Reflection::instance(PrototypeChildClass::class), $methods['childMethod']->getDeclaringClass());
        $this->assertEquals(Reflection::instance(PrototypeParentClass::class), $methods['parentMethod']->getDeclaringClass());
        $this->assertEquals(Reflection::instance(PrototypeTrait::class), $methods['traitMethod']->getDeclaringClass());
    }

    function test_getLocation_misc()
    {
        eval('class abcdefg{const a=1;var $b;}');
        $reflection = (Reflection::instance('abcdefg'));
        $this->assertEquals([
            'start' => null,
            'end'   => null,
        ], array_pickup($reflection->getConstants()['a']->getLocation(), ['start', 'end']));
        $this->assertEquals([
            'start' => null,
            'end'   => null,
        ], array_pickup($reflection->getProperties()['b']->getLocation(), ['start', 'end']));
    }

    function test_getGetDocComments()
    {
        $closure = /** function */
            function (
                /** arg1 */ int $arg1,
                int $arg2,
            ) /** return */ {
            };
        $reflection = (Reflection::instance(new \ReflectionFunction($closure)));
        $this->assertEquals([
            '' => "/** function */",
            0  => "/** arg1 */",
            -1 => "/** return */",
        ], $reflection->getDocComments());
    }

    function test_getAttributes()
    {
        $closure = function (
            #[Attr(1, 2)] int $arg1,
            #[Attr(1, c: 3)] int $arg2,
        ) {
        };
        $reflection = (Reflection::instance(new \ReflectionFunction($closure)));
        $parameters = $reflection->getParameters();
        $this->assertEquals([
            [
                'name'        => 'ryunosuke\\Test\\Documentize\\Attr',
                'arguments'   => [1, 2],
                'declaration' => '1, 2',
            ],
        ], $parameters['arg1']->getAttributes());
        $this->assertEquals([
            [
                'name'        => 'ryunosuke\\Test\\Documentize\\Attr',
                'arguments'   => [1, 'c' => 3],
                'declaration' => '1, c: 3',
            ],
        ], $parameters['arg2']->getAttributes());
    }

    function test_misc()
    {
        $reflection = Reflection::instance(new \ReflectionExtension('Reflection'));
        $this->assertException(new \DomainException(), [$reflection, 'getCategory']);
        $this->assertException(new \DomainException(), [$reflection, 'getFqsen']);
        $this->assertException(new \DomainException(), [$reflection, 'getNamespaceName']);
        $this->assertException(new \DomainException(), [$reflection, 'getShortName']);
        $this->assertException(new \DomainException(), [$reflection, 'getFileName']);
        $this->assertException(new \DomainException(), [$reflection, 'getLocation'], '');
        $this->assertException(new \DomainException(), [$reflection, 'getDocComments']);
        $this->assertException(new \DomainException(), [$reflection, 'getDocComment']);
        $this->assertException(new \DomainException(), [$reflection, 'getLastModified']);
        $this->assertException(new \DomainException(), [$reflection, 'getDeclaringClass']);
        $this->assertException(new \DomainException(), [$reflection, 'getProtoType']);
        $this->assertException(new \DomainException(), [$reflection, 'getProtoTypes']);
        $this->assertException(new \DomainException(), [$reflection, 'getType']);
        $this->assertException(new \DomainException(), [$reflection, 'hasValue']);
        $this->assertException(new \DomainException(), [$reflection, 'getValue']);
    }
}
