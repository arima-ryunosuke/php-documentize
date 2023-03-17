<?php

namespace NS;

/** constcomment */
const MockConstant = 1;

/** funccomment */
function MockFunction(int $defc = \PHP_VERSION_ID, array $defa = [1, 2, 3], string &...$params): int { }

/** interfacecomment */
interface MockInterface
{
    /** interfaceconstcomment */
    const mockConstant = 1;

    /** interfacemethodcomment */
    function mockMethod();
}

/** traitcomment */
trait MockTrait
{
    /** traitpropertycomment */
    protected $mockProperty = 1;

    /** traitmethodcomment */
    public function mockMethod() { }
}

class MockParent
{
}

/** classcomment */
class MockClass extends MockParent implements MockInterface
{
    use MockTrait;

    /** classpropertycomment */
    protected $mockProperty = 1;

    /** classmethodcomment */
    public function mockMethod(): MockClass { }
}

interface PrototypeInterface
{
    const interfaceConstant = 0;

    public function interfaceMethod();
}

trait PrototypeTrait
{
    public $traitProperty;

    public function traitMethod() { }
}

class PrototypeParentClass
{
    const parentConstant = 0;

    public $parentProperty;

    public $overrideProperty;

    public function __construct() { }

    public function parentMethod() { }

    public function overrideMethod() { }
}

class PrototypeChildClass extends PrototypeParentClass implements PrototypeInterface
{
    use PrototypeTrait;

    const parentConstant = 0;

    const childConstant = 0;

    public $overrideProperty;

    public $childProperty;

    public function __construct() { }

    public function interfaceMethod() { }

    public function overrideMethod() { }

    public function childMethod() { }
}

class StaticPropertyClass
{
    protected static $staticProperty = MockInterface::mockConstant;
}

class TypedClass
{
    public ?array $typedProperty = [];

    public function typedMethod(?array $arg1): ?string { }
}

// このような undefined なプロパティがあると巻き添えで取れるはずの static も取れなくなるので↑とは分けてある
class UndefinedPropertyClass
{
    protected $undefinedProperty = self::CONSTANT;
}

/**
 * @property int $magicProperty
 * @method int magicMethod()
 */
class MagicClass
{
}
