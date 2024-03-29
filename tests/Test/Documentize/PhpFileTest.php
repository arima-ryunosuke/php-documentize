<?php

namespace ryunosuke\Test\Documentize;

use ryunosuke\Documentize\PhpFile;
use function ryunosuke\Documentize\array_pickup;

class PhpFileTest extends \ryunosuke\Test\AbstractUnitTestCase
{
    function test_cache()
    {
        $this->assertSame((new PhpFile(__FILE__))->gather(), PhpFile::cache(__FILE__));
        $this->assertSame((new PhpFile(__FILE__))->gather(), PhpFile::cache(null)[__FILE__]);
        $this->assertSame('forced setting', PhpFile::cache(__FILE__, 'forced setting'));
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
        $phpfile->next();
        $phpfile->next();
        $this->assertEquals("<?php\n", $phpfile->current()[1]);
        if (version_compare(PHP_VERSION, 8.0) >= 0) {
            $this->assertEquals("namespace|{|use|\ArrayObject|as|AO|;", implode('|', array_column($phpfile->next(T_CLASS), 1)));
        }
        else {
            $this->assertEquals("namespace|{|use|\|ArrayObject|as|AO|;", implode('|', array_column($phpfile->next(T_CLASS), 1)));
        }
        $this->assertEquals("C", $phpfile->next()[1]);
        $phpfile->next('DE');
        $this->assertEquals("DE", $phpfile->current()[1]);
        $this->assertEquals(";", implode('|', array_column($phpfile->next(T_TRAIT), 1)));
        $this->assertEquals("T", $phpfile->next()[1]);

        $phpfile->next('END');
        $this->assertEquals(false, $phpfile->current());
        $this->assertEquals(false, $phpfile->next());
        $this->assertEquals(false, $phpfile->next(T_NAMESPACE));
        $this->assertEquals([ord('}'), '}', 13], array_pickup($phpfile->prev(), [0, 1, 2]));
        $this->assertEquals([ord('}'), '}', 12], array_pickup($phpfile->prev(), [0, 1, 2]));
        $this->assertEquals([ord('{'), '{', 12], array_pickup($phpfile->prev(), [0, 1, 2]));
        $this->assertEquals([ord('{'), '{', 12], array_pickup($phpfile->current(), [0, 1, 2]));
        $this->assertEquals([T_NAMESPACE, 'namespace', 8], array_pickup($phpfile->prev(T_NAMESPACE)[0], [0, 1, 2]));

        $this->assertEquals(T_OPEN_TAG, $phpfile->reset()->current()[0]);
    }

    function test_gather()
    {
        $phpfile = new PhpFile(__DIR__ . '/_PhpFileTest/all.php');

        // 行数がコロコロ変わってとてもしんどいのでコピペ用（コピった場合差分は確認すること）
        //\ryunosuke\Documentize\Utils\Vars::var_export2($phpfile->gather());

        $this->assertEquals([
            'vendor'           => [
                '@comment' => '/**
 * namespace vendor comment
 */',
                '@using'   => [
                    'Ttrait' => 'vendor\\Ttrait',
                    'Single' => 'vendor\\Single',
                    'Hoge'   => 'vendor\\Hoge',
                    'Fuga'   => 'vendor\\Fuga',
                    'Piyo'   => 'vendor\\Piyo',
                ],
                '@const'   => [],
            ],
            'vendor\\Inner'    => [
                '@comment' => '/**
 * namespace vendor\\Inner comment
 */',
                '@using'   => [
                    'Foo' => 'vendor\\Inner\\Foo',
                    'Bar' => 'vendor\\Inner\\Bar',
                ],
                '@const'   => [],
            ],
            'vendor\\subspace' => [
                '@comment' => '',
                ''         => [
                    'FOO'   => [46, 46],
                    'bar()' => [null, null],
                ],
                '@const'   => [
                    'FOO' => '/** const doc */',
                ],
                '@using'   => [
                    'SubClass' => 'vendor\\subspace\\SubClass',
                ],
            ],
            ''                 => [
                '@comment' => '/**
 * namespace global comment
 */',
                '@using'   => [
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
                '@const'   => [],
                ''         => [
                    'f()' => [null, null],
                ],
                'C'        => [
                    'method()' => [null, null],
                ],
                'I'        => [
                    'INTERFACE_CONST' => [96, 99],
                    'method()'        => [null, null],
                ],
                'T'        => [
                    'method1()'       => [null, null],
                    '$staticProperty' => [112, 112],
                    '$traitProperty'  => [113, 115],
                    'method2()'       => [null, null],
                ],
            ],
            'NS'               => [
                '@comment' => '',
                '@using'   => [
                    'P' => 'NS\\P',
                    'C' => 'NS\\C',
                ],
                '@const'   => [],
                'NS\\P'    => [
                    'EXTERNAL'    => [129, 129],
                    'CLASS_CONST' => [130, 130],
                ],
                'NS\\C'    => [
                    'method1()'       => [null, null],
                    'PRIVATE_CONST'   => [143, 143],
                    'PUBLIC_CONST'    => [144, 144],
                    '$staticProperty' => [146, 146],
                    '$classProperty'  => [147, 150],
                    'method2()'       => [null, null],
                    'method()'        => [null, null],
                    'func()'          => [null, null],
                    'refunc()'        => [null, null],
                ],
            ],
        ], $phpfile->gather());
    }
}
