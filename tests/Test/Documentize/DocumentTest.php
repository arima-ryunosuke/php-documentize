<?php

namespace ryunosuke\Test\Documentize;

use ryunosuke\Documentize\Document;

class DocumentTest extends \ryunosuke\Test\AbstractUnitTestCase
{
    function test_gatherIsolative()
    {
        $result = Document::gatherIsolative([
            'target'     => __DIR__ . '/_DocumentTest/all.php',
            'autoloader' => __DIR__ . '/_DocumentTest/autoloader.php',
            'cachedir'   => sys_get_temp_dir(),
            'include'    => '*',
            'contain'    => '*',
            'recursive'  => true,
        ]);
        $namespaces = $result['namespaces'];

        $this->assertArrayHasKey('GlobalSpace', $namespaces);
        $this->assertArrayHasKey('constants', $namespaces['GlobalSpace']);
        $this->assertArrayHasKey('globalConstant', $namespaces['GlobalSpace']['constants']);
    }

    function test_gatherIsolative_err()
    {
        $result = Document::gatherIsolative([
            'target'     => __DIR__ . '/_DocumentTest/err.php',
            'autoloader' => __DIR__ . '/_DocumentTest/autoloader.php',
            'cachedir'   => sys_get_temp_dir(),
            'include'    => '*',
            'contain'    => '*',
            'recursive'  => true,
        ], $logs);
        $this->assertFalse($result);
        $this->assertContains('err!', $logs);
    }

    function test_gather()
    {
        /// カバレッジのためにざっくりとテスト（メンテで死ぬので細かくはやらない）

        touch(__DIR__ . '/_DocumentTest/all.php');
        $document = new Document([
            'target'     => __DIR__ . '/_DocumentTest/all.php',
            'autoloader' => __DIR__ . '/_DocumentTest/autoloader.php',
            'cachedir'   => sys_get_temp_dir(),
            'include'    => '*',
            'contain'    => '*',
            'recursive'  => true,
        ]);
        $namespaces = $document->gather();

        $this->assertEquals(123, defined('LOADED'));

        $this->assertArrayHasKey('GlobalSpace', $namespaces);
        $this->assertArrayHasKey('constants', $namespaces['GlobalSpace']);
        $this->assertArrayHasKey('globalConstant', $namespaces['GlobalSpace']['constants']);
        $this->assertArrayHasKey('abc_function', $namespaces['A']['namespaces']['B']['namespaces']['C']['functions']);

        /// なんかテストしたいことがあったらここに随時記述（↑の通り全項目の細かいテストはやらん）

        $this->assertException('is not found', function () {
            $document = new Document([
                'target' => 'notfound directory',
            ]);
            $document->gather();
        });
    }

    function test_gather_dir()
    {
        $document = new Document([
            'target'  => __DIR__ . '/_DocumentTest/dir',
            'include' => '*',
            'contain' => '*'
        ]);
        $namespaces = $document->gather();
        $this->assertEquals('class', $namespaces['']['classes']['SubDirClass1']['category']);
    }

    function test_gather_skip1()
    {
        $document = new Document([
            'target'                 => __DIR__ . '/_DocumentTest/ignore.php',
            'include'                => '*',
            'contain'                => ['IgnoreSpace1', 'IgnoreSpace2', '*normal'],
            'except'                 => ['IgnoreSpace1', '*except'],
            'no-internal-function'   => true,
            'no-deprecated-function' => true,
            'no-internal-type'       => true,
            'no-deprecated-type'     => true,
            'no-internal-constant'   => true,
            'no-deprecated-constant' => true,
            'no-virtual-constant'    => true,
            'no-private-constant'    => true,
            'no-protected-constant'  => true,
            'no-public-constant'     => true,
            'no-magic-property'      => true,
            'no-internal-property'   => true,
            'no-deprecated-property' => true,
            'no-virtual-property'    => true,
            'no-private-property'    => true,
            'no-protected-property'  => true,
            'no-public-property'     => true,
            'no-magic-method'        => true,
            'no-internal-method'     => true,
            'no-deprecated-method'   => true,
            'no-virtual-method'      => true,
            'no-private-method'      => true,
            'no-protected-method'    => true,
            'no-public-method'       => true,
        ]);
        $namespaces = $document->gather();

        // 色々いるが、 contain により除外される
        $this->assertArrayNotHasKey('', $namespaces);
        $this->assertArrayNotHasKey('IgnoreSpace1', $namespaces);
        // nocontain 関数がいるが、 contain により除外される
        $this->assertArrayNotHasKey('IgnoreSpace3', $namespaces);

        // except なので false
        $this->assertArrayNotHasKey('exceptF', $namespaces['IgnoreSpace2']['functions']);
        // @deprecated なので false
        $this->assertArrayNotHasKey('deprecatedF', $namespaces['IgnoreSpace2']['functions']);
        // @internal なので false
        $this->assertArrayNotHasKey('internalF', $namespaces['IgnoreSpace2']['functions']);
        // @ignore なので false
        $this->assertArrayNotHasKey('ignoreF', $namespaces['IgnoreSpace2']['functions']);
        // こいつは居る
        $this->assertArrayHasKey('normalF', $namespaces['IgnoreSpace2']['functions']);

        // except なので false
        $this->assertArrayNotHasKey('exceptC', $namespaces['IgnoreSpace2']['classes']);
        // @deprecated なので false
        $this->assertArrayNotHasKey('deprecatedC', $namespaces['IgnoreSpace2']['classes']);
        // @internal なので false
        $this->assertArrayNotHasKey('internalC', $namespaces['IgnoreSpace2']['classes']);
        // @ignore なので false
        $this->assertArrayNotHasKey('ignoreC', $namespaces['IgnoreSpace2']['classes']);
        // こいつは居る
        $this->assertArrayHasKey('normalC', $namespaces['IgnoreSpace2']['classes']);
        // すべて何らかの形で無視されるので定数の数は 0
        $this->assertCount(0, $namespaces['IgnoreSpace2']['classes']['C']['constants']);
        // すべて何らかの形で無視されるのでプロパティの数は 0
        $this->assertCount(0, $namespaces['IgnoreSpace2']['classes']['C']['properties']);
        // すべて何らかの形で無視されるのでメソッドの数は 0
        $this->assertCount(0, $namespaces['IgnoreSpace2']['classes']['C']['methods']);

        // すべて何らかの形で無視されるので定数の数は 0
        $this->assertCount(0, $namespaces['IgnoreSpace2']['classes']['C2']['constants']);
        // すべて何らかの形で無視されるのでプロパティの数は 0
        $this->assertCount(0, $namespaces['IgnoreSpace2']['classes']['C2']['properties']);
        // すべて何らかの形で無視されるのでメソッドの数は 0
        $this->assertCount(0, $namespaces['IgnoreSpace2']['classes']['C2']['methods']);
    }

    function test_gather_skip2()
    {
        $document = new Document([
            'target'               => __DIR__ . '/_DocumentTest/magic.php',
            'include'              => '*',
            'contain'              => '*',
            'no-magic-property'    => false,
            'no-magic-method'      => false,
            'no-internal-method'   => true,
            'no-deprecated-method' => true,
        ]);
        $namespaces = $document->gather();

        // マジックプロパティにも @deprecated や @internal が効いているので 0
        $this->assertCount(0, $namespaces['']['classes']['C']['properties']);
        // マジックメソッドにも @deprecated や @internal が効いているので 0
        $this->assertCount(0, $namespaces['']['classes']['C']['methods']);
    }

    function test_gather_log()
    {
        $document = new Document([
            'target'  => __DIR__ . '/_DocumentTest/error.php',
            'include' => '*',
            'contain' => '*',
        ]);
        $document->gather($logs);
        $logs = array_column($logs, 'message');
        $this->assertContains("Undefined variable: t", $logs);
        $this->assertContains("Use of undefined constant UNDEFINED - assumed 'UNDEFINED'", $logs);
        $this->assertContains("ChildClass uses inheritdoc, but Invalid is not found.", $logs);
        $this->assertContains("ChildClass::method() uses inheritdoc, but Invalid::invalid() is not found.", $logs);
    }

    function test_parseFile()
    {
        $document = new Document([
            'target'  => __DIR__,
            'include' => 'Test.php',
            'exclude' => 'ReflectionTest.php',
        ]);
        self::forcedWrite($document, 'targetdir', __DIR__);
        $parseFile = self::forcedCallize($document, 'parseFile');

        $this->assertTrue($parseFile(__FILE__));
        // 存在しないので false
        $this->assertFalse($parseFile('notfound'));
        // 既に読み込んでるので false
        $this->assertFalse($parseFile(__FILE__));
        // 対象ディレクトリ外なので false
        $this->assertFalse($parseFile(__DIR__ . '/../AbstractUnitTestCase.php'));
        // include にマッチしないので false
        $this->assertFalse($parseFile(__DIR__ . '/_ReflectionTest/all.php'));
        // exclude にマッチするので false
        $this->assertFalse($parseFile(__DIR__ . '/ReflectionTest.php'));
    }

    function test_parseDoccomment()
    {
        $document = new Document([
            'target'  => __DIR__,
            'include' => '*',
        ]);
        $parseDoccomment = self::forcedCallize($document, 'parseDoccomment');

        $comment = $parseDoccomment('/**
 * this is description{@inline1 tag}{@inline2 tag}
 *
 * this is description1.
 * this is description2.
 * there is inline tag.{@inlinetag}
 *
 * @tagname1 tagvalue1
 * @tagname2 tagvalue21
 * @tagname2 tagvalue22
 */
', null, null);
        $this->assertEquals("this is description<tag-inline1  /><tag-inline2  />

this is description1.
this is description2.
there is inline tag.<tag-inlinetag  />

", $comment['description']);

        $this->assertEquals(['inline1', 'inline2', 'inlinetag', 'tagname1', 'tagname2'], array_keys($comment['tags']));
    }
}
