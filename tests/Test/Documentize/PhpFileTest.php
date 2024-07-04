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
        $this->assertEquals("<?php\n", $phpfile->current()->text);
        $this->assertEquals("namespace|{|use|\ArrayObject|as|AO|;", implode('|', array_column($phpfile->next(T_CLASS), 'text')));
        $this->assertEquals("C", $phpfile->next()->text);
        $phpfile->next('DE');
        $this->assertEquals("DE", $phpfile->current()->text);
        $this->assertEquals(";", implode('|', array_column($phpfile->next(T_TRAIT), 'text')));
        $this->assertEquals("T", $phpfile->next()->text);

        $phpfile->next('END');
        $this->assertEquals(false, $phpfile->current());
        $this->assertEquals(false, $phpfile->next());
        $this->assertEquals(false, $phpfile->next(T_NAMESPACE));
        $this->assertEquals([ord('}'), '}', 13], array_pickup($phpfile->prev(), ['id' => 0, 'text' => 1, 'line' => 2]));
        $this->assertEquals([ord('}'), '}', 12], array_pickup($phpfile->prev(), ['id' => 0, 'text' => 1, 'line' => 2]));
        $this->assertEquals([ord('{'), '{', 12], array_pickup($phpfile->prev(), ['id' => 0, 'text' => 1, 'line' => 2]));
        $this->assertEquals([ord('{'), '{', 12], array_pickup($phpfile->current(), ['id' => 0, 'text' => 1, 'line' => 2]));
        $this->assertEquals([T_NAMESPACE, 'namespace', 8], array_pickup($phpfile->prev(T_NAMESPACE)[0], ['id' => 0, 'text' => 1, 'line' => 2]));

        $this->assertEquals(T_OPEN_TAG, $phpfile->reset()->current()->id);
    }

    function test_gather()
    {
        $phpfile = new PhpFile(__DIR__ . '/_PhpFileTest/all.php');

        // 行数がコロコロ変わってとてもしんどいのでコピペ用（コピった場合差分は確認すること）
        //\ryunosuke\Documentize\var_export2($phpfile->gather());

        $this->assertEquals([
            "vendor"           => [
                "@comment" => <<<TEXT
                /**
                 * namespace vendor comment
                 */
                TEXT,
                "@using"   => [
                    "Ttrait" => "vendor\\Ttrait",
                    "Single" => "vendor\\Single",
                    "Hoge"   => "vendor\\Hoge",
                    "Fuga"   => "vendor\\Fuga",
                    "Piyo"   => "vendor\\Piyo",
                ],
                "@const"   => [],
            ],
            "vendor\\Inner"    => [
                "@comment" => <<<TEXT
                /**
                 * namespace vendor\\Inner comment
                 */
                TEXT,
                "@using"   => [
                    "Foo" => "vendor\\Inner\\Foo",
                    "Bar" => "vendor\\Inner\\Bar",
                ],
                "@const"   => [],
            ],
            "vendor\\subspace" => [
                "@comment" => "",
                "@using"   => [
                    "SubClass" => "vendor\\subspace\\SubClass",
                ],
                "@const"   => [
                    "FOO" => "/** const doc */",
                ],
                ""         => [
                    "FOO"   => [46, 46],
                    "bar()" => [null, null],
                ],
            ],
            ""                 => [
                "@comment" => <<<TEXT
                /**
                 * namespace global comment
                 */
                TEXT,
                "@using"   => [
                    "AO"       => "ArrayObject",
                    "Single"   => "vendor\\Single",
                    "Fuga"     => "vendor\\Fuga",
                    "Hoge"     => "vendor\\Hoge",
                    "InnerBar" => "vendor\\Inner\\Bar",
                    "Foo"      => "vendor\\Inner\\Foo",
                    "Piyo"     => "vendor\\Piyo",
                    "Sub"      => "vendor\\subspace",
                    "Ttrait"   => "vendor\\Ttrait",
                    "C"        => "C",
                    "I"        => "I",
                    "T"        => "T",
                ],
                "@const"   => [],
                ""         => [
                    "f()" => [null, null],
                ],
                "C"        => [
                    "method()" => [null, null],
                ],
                "I"        => [
                    "INTERFACE_CONST" => [92, 95],
                    "method()"        => [null, null],
                ],
                "T"        => [
                    "method1()"        => [null, null],
                    "\$staticProperty" => [108, 108],
                    "\$traitProperty"  => [109, 111],
                    "method2()"        => [null, null],
                ],
            ],
            "NS"               => [
                "@comment" => "",
                "@using"   => [
                    "P" => "NS\\P",
                    "C" => "NS\\C",
                ],
                "@const"   => [],
                "NS\\P"    => [
                    "EXTERNAL"    => [125, 125],
                    "CLASS_CONST" => [126, 126],
                ],
                "NS\\C"    => [
                    "method1()"        => [null, null],
                    "PRIVATE_CONST"    => [139, 139],
                    "PUBLIC_CONST"     => [140, 140],
                    "\$staticProperty" => [142, 142],
                    "\$classProperty"  => [143, 146],
                    "method2()"        => [null, null],
                    "method()"         => [null, null],
                    "func()"           => [null, null],
                    "refunc()"         => [null, null],
                ],
            ],
        ], $phpfile->gather());
    }
}
