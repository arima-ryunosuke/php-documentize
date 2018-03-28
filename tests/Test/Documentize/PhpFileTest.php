<?php

namespace ryunosuke\Test\Documentize;

use ryunosuke\Documentize\PhpFile;

class PhpFileTest extends \ryunosuke\Test\AbstractUnitTestCase
{
    function test_evaluate()
    {
        $x = 123;
        $this->assertEquals(246, PhpFile::evaluate('return $x * 2;', get_defined_vars()));

        $this->assertException("eval failed. invalid code", [PhpFile::class, 'evaluate'], 'invalid code');
    }

    function test_cache()
    {
        $this->assertSame((new PhpFile(__FILE__))->gather(), PhpFile::cache(__FILE__));
        $this->assertSame((new PhpFile(__FILE__))->gather(), PhpFile::cache(null)[__FILE__]);
    }

    function test_iterate()
    {
        $phpfile = new PhpFile(<<<PHPCODE
<?php
namespace {
    use \ArrayObject as AO;

    class C {}
}

namespace NS {
    use \RuntimeException;
    use \DomainException as DE;

    trait T {}
}
PHPCODE
        );

        $this->assertSame($phpfile, $phpfile->reset());

        $this->assertEquals(false, $phpfile->prev());

        $this->assertEquals("<?php\n", $phpfile->current()[1]);
        $this->assertEquals("namespace|{|use|\|ArrayObject|as|AO|;", implode('|', array_column($phpfile->skip(T_CLASS), 1)));
        $this->assertEquals("C", $phpfile->next()[1]);
        $phpfile->skip('DE');
        $this->assertEquals("DE", $phpfile->current()[1]);
        $this->assertEquals(";", implode('|', array_column($phpfile->skip(T_TRAIT), 1)));
        $this->assertEquals("T", $phpfile->next()[1]);

        $phpfile->skip('END');
        $this->assertEquals(false, $phpfile->current());
        $this->assertEquals(false, $phpfile->next());
        $this->assertEquals(false, $phpfile->skip(T_NAMESPACE));
        $this->assertEquals([null, '}', 0], $phpfile->prev());
        $this->assertEquals([null, '}', 0], $phpfile->prev());
        $this->assertEquals([null, '{', 0], $phpfile->prev());
        $this->assertEquals([null, '{', 0], $phpfile->current());

        $this->assertEquals(T_OPEN_TAG, $phpfile->reset()->current()[0]);
    }

    function test_gather()
    {
        $phpfile = new PhpFile(__DIR__ . '/_PhpFileTest/all.php');

        // 行数がコロコロ変わってとてもしんどいのでコピペ用（コピった場合差分は確認すること）
        //\ryunosuke\Documentize\Utils\Vars::var_export2($phpfile->gather());

        $this->assertEquals([
            'vendor'           => [
                '@using' => [
                    'Ttrait' => 'vendor\\Ttrait',
                    'Single' => 'vendor\\Single',
                    'Hoge'   => 'vendor\\Hoge',
                    'Fuga'   => 'vendor\\Fuga',
                    'Piyo'   => 'vendor\\Piyo',
                ],
            ],
            'vendor\\Inner'    => [
                '@using' => [
                    'Foo' => 'vendor\\Inner\\Foo',
                    'Bar' => 'vendor\\Inner\\Bar',
                ],
            ],
            'vendor\\subspace' => [
                ''       => [
                    'FOO'   => [39, 39],
                    'bar()' => [null, null],
                ],
                '@using' => [
                    'SubClass' => 'vendor\\subspace\\SubClass',
                ],
            ],
            ''                 => [
                '@using' => [
                    'AO'       => 'ArrayObject',
                    'Single'   => 'vendor\\Single',
                    'Fuga'     => 'vendor\\Fuga',
                    'Hoge'     => 'vendor\\Hoge',
                    'InnerBar' => 'vendor\\Inner\\Bar',
                    'Foo'      => 'vendor\\Inner\\Foo',
                    'Piyo'     => 'vendor\\Piyo',
                    'Sub'      => 'vendor\\subspace',
                    'Ttrait'   => 'vendor\\Ttrait',
                    'C'        => 'C',
                    'I'        => 'I',
                    'T'        => 'T',
                ],
                ''       => [
                    'f()' => [null, null],
                ],
                'C'      => [
                    'method()' => [null, null],
                ],
                'I'      => [
                    'INTERFACE_CONST' => [86, 89],
                    'method()'        => [null, null],
                ],
                'T'      => [
                    'method1()'       => [null, null],
                    '$staticProperty' => [102, 102],
                    '$traitProperty'  => [103, 105],
                    'method2()'       => [null, null],
                ],
            ],
            'NS'               => [
                '@using' => [
                    'P' => 'NS\\P',
                    'C' => 'NS\\C',
                ],
                'NS\\P'  => [
                    'EXTERNAL'    => [119, 119],
                    'CLASS_CONST' => [120, 120],
                ],
                'NS\\C'  => [
                    'method1()'       => [null, null],
                    'PRIVATE_CONST'   => [133, 133],
                    'PUBLIC_CONST'    => [134, 134],
                    '$staticProperty' => [136, 136],
                    '$classProperty'  => [137, 140],
                    'method2()'       => [null, null],
                    'method()'        => [null, null],
                    'func()'          => [null, null],
                    'refunc()'        => [null, null],
                ],
            ],
        ], $phpfile->gather());
    }
}
