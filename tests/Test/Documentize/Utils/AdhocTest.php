<?php

namespace ryunosuke\Test\Documentize\Utils;

use ryunosuke\Documentize\Utils\Adhoc;

class AdhocTest extends \ryunosuke\Test\AbstractUnitTestCase
{
    function test_fnmatchs()
    {
        $this->assertTrue(Adhoc::fnmatchs(['*aaa*', '*bbb*', '*ccc*'], 'aaa'));
        $this->assertTrue(Adhoc::fnmatchs(['*aaa*', '*bbb*', '*ccc*'], 'bbb'));
        $this->assertTrue(Adhoc::fnmatchs(['*aaa*', '*bbb*', '*ccc*'], 'ccc'));
        $this->assertTrue(Adhoc::fnmatchs(['*aaa*', '*bbb*', '*ccc*'], 'xaaax'));
        $this->assertFalse(Adhoc::fnmatchs(['aaa', 'bbb', 'ccc'], 'xaaax'));
        $this->assertFalse(Adhoc::fnmatchs(['*aaa*', '*bbb*', '*ccc*'], 'xxx'));
    }

    function test_explode()
    {
        $this->assertEquals([
            'a',
            '"x,y"',
            '["y", "z"]',
            'c\,d',
            "'e,f'"
        ], Adhoc::explode('a,"x,y",["y", "z"],c\\,d,\'e,f\'', ',', ['[' => ']', '"' => '"', "'" => "'"], '\\'));
    }
}
