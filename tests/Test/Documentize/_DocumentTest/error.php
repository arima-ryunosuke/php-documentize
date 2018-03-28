<?php

trigger_error('DEPRECATED', E_USER_DEPRECATED);
@trigger_error('@NOTICE');
$t = $t;

/**
 * {@inheritdoc Invalid}
 */
class ChildClass extends ParentClass
{
    const undefined = UNDEFINED;

    /**
     * {@inheritdoc Invalid::invalid()}
     */
    function method() { }
}
