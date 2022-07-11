<?php

trigger_error('DEPRECATED', E_USER_DEPRECATED);
@trigger_error('@NOTICE');
$t = $t;

/**
 * {@inheritdoc Invalid}
 */
class ChildClass
{
    /**
     * {@inheritdoc Invalid::invalid()}
     *
     * @see \UndefinedClass
     * @see \ChildClass::unknownConst
     * @see \ChildClass::$unknownProperty
     * @see \ChildClass::unknownMethod()
     */
    function method() { }
}
