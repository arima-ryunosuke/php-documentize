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
        $namespaces = $result['result']['namespaces'];

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
        $namespaces = $document->gather()['namespaces'];

        $this->assertEquals(123, defined('LOADED'));

        $this->assertArrayHasKey('GlobalSpace', $namespaces);
        $this->assertArrayHasKey('constants', $namespaces['GlobalSpace']);
        $this->assertArrayHasKey('globalConstant', $namespaces['GlobalSpace']['constants']);
        $this->assertArrayHasKey('abc_function', $namespaces['A']['namespaces']['B']['namespaces']['C']['functions']);
        $this->assertEquals('ABC comment', $namespaces['A']['namespaces']['B']['namespaces']['C']['description']);

        $methods = $namespaces['GlobalSpace']['classes']['GlobalClass']['methods'];
        $this->assertEquals("override classMethod1 arg comment\n", $methods['classMethod1']['parameters'][0]['description']);
        $this->assertEquals("override classMethod1 return comment", $methods['classMethod1']['return']['description']);
        $this->assertEquals("classMethod2 arg comment\n", $methods['classMethod2']['parameters'][0]['description']);
        $this->assertEquals("classMethod2 return comment", $methods['classMethod2']['return']['description']);

        $uses = array_intersect_key($methods, ['usedByMethod' => true, 'magicMethod' => true]);
        $this->assertSame(['usedByMethod', 'magicMethod'], array_keys($uses));

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
        $namespaces = $document->gather()['namespaces'];
        $this->assertEquals('class', $namespaces['']['classes']['SubDirClass1']['category']);
    }

    function test_gather_skip1()
    {
        $document = new Document([
            'target'                      => __DIR__ . '/_DocumentTest/ignore.php',
            'include'                     => '*',
            'contain'                     => ['IgnoreSpace1', 'IgnoreSpace2', '*normal'],
            'except'                      => ['IgnoreSpace1', '*except'],
            'no-constant'                 => true,
            'no-function'                 => false,
            'no-internal-function'        => true,
            'no-deprecated-function'      => true,
            'no-internal-type'            => true,
            'no-deprecated-type'          => true,
            'no-internal-constant'        => true,
            'no-internal-classconstant'   => true,
            'no-deprecated-constant'      => true,
            'no-deprecated-classconstant' => true,
            'no-virtual-classconstant'    => true,
            'no-private-classconstant'    => true,
            'no-protected-classconstant'  => true,
            'no-public-classconstant'     => true,
            'no-magic-property'           => true,
            'no-internal-property'        => true,
            'no-deprecated-property'      => true,
            'no-virtual-property'         => true,
            'no-private-property'         => true,
            'no-protected-property'       => true,
            'no-public-property'          => true,
            'no-magic-method'             => true,
            'no-internal-method'          => true,
            'no-deprecated-method'        => true,
            'no-virtual-method'           => true,
            'no-private-method'           => true,
            'no-protected-method'         => true,
            'no-public-method'            => true,
        ]);
        $namespaces = $document->gather()['namespaces'];

        // 色々いるが、 contain により除外される
        $this->assertArrayNotHasKey('', $namespaces);
        $this->assertArrayNotHasKey('IgnoreSpace1', $namespaces);
        // nocontain 関数がいるが、 contain により除外される
        $this->assertArrayNotHasKey('IgnoreSpace3', $namespaces);

        // no-constant なので false
        $this->assertArrayNotHasKey('C', $namespaces['IgnoreSpace2']['constants']);
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
        $this->assertCount(0, $namespaces['IgnoreSpace2']['classes']['C']['classconstants']);
        // すべて何らかの形で無視されるのでプロパティの数は 0
        $this->assertCount(0, $namespaces['IgnoreSpace2']['classes']['C']['properties']);
        // すべて何らかの形で無視されるのでメソッドの数は 0
        $this->assertCount(0, $namespaces['IgnoreSpace2']['classes']['C']['methods']);

        // すべて何らかの形で無視されるので定数の数は 0
        $this->assertCount(0, $namespaces['IgnoreSpace2']['classes']['C2']['classconstants']);
        // すべて何らかの形で無視されるのでプロパティの数は 0
        $this->assertCount(0, $namespaces['IgnoreSpace2']['classes']['C2']['properties']);
        // すべて何らかの形で無視されるのでメソッドの数は 0
        $this->assertCount(0, $namespaces['IgnoreSpace2']['classes']['C2']['methods']);
    }

    function test_gather_skip2()
    {
        $document = new Document([
            'target'  => __DIR__ . '/_DocumentTest/ignore-inherit.php',
            'include' => '*',
            'contain' => '*',
        ]);
        $namespaces = $document->gather()['namespaces'];

        // こいつは居る
        $this->assertArrayHasKey('IgnoreInheritT', $namespaces['Ignore']['traits']);
        // メソッドもある
        $this->assertArrayHasKey('ignoreM', $namespaces['Ignore']['traits']['IgnoreInheritT']['methods']);
        $this->assertArrayHasKey('noignoreM', $namespaces['Ignore']['traits']['IgnoreInheritT']['methods']);
        // ただし、 ignoreM は use 先 C にはいない（noignoreM はオーバーライドしてるので居る）
        $this->assertArrayNotHasKey('ignoreM', $namespaces['Ignore']['classes']['C']['methods']);
        $this->assertArrayHasKey('noignoreM', $namespaces['Ignore']['classes']['C']['methods']);
    }

    function test_gather_skip3()
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
        $namespaces = $document->gather()['namespaces'];

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
        $this->assertContains("ChildClass uses inheritdoc, but Invalid is not found.", $logs);
        $this->assertContains("ChildClass::method() uses inheritdoc, but Invalid::invalid() is not found.", $logs);
        $this->assertContains("'UndefinedClass' is undefined type in (ChildClass)", $logs);
        $this->assertContains("'ChildClass::unknownConst()' is unknown member in (ChildClass)", $logs);
        $this->assertContains("'ChildClass::\$unknownProperty' is unknown member in (ChildClass)", $logs);
        $this->assertContains("'ChildClass::unknownMethod()' is unknown member in (ChildClass)", $logs);
    }

    function test_gatherMarkdown()
    {
        $document = new Document([
            'target'  => __DIR__ . '/_DocumentTest/test.md',
        ]);
        $markdowns = $document->gather()['markdowns'];

        $this->assertArrayHasKey('test.md', $markdowns);

        $this->assertArrayHasKey('hash', $markdowns['test.md']);
        $this->assertEquals(40, strlen($markdowns['test.md']['hash']));

        $this->assertArrayHasKey('index', $markdowns['test.md']);
        $this->assertEquals('header-e192bb1a18afdb8d546a8a7f9d813e97e9e23eea-1', $markdowns['test.md']['index'][0]['id']);
        $this->assertContains('h1', $markdowns['test.md']['index'][0]['content']);

        $this->assertArrayHasKey('html', $markdowns['test.md']);
        $this->assertContains('<tag_link', $markdowns['test.md']['html']);
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
 * there is special tag.<@specialtag>
 *
 * - list1:    {@inlisttag1}
 * - list2:    {@inlisttag2}
 *
 * @property hoge() {
 *     {@internaltag1}
 *     text <@internaltag2> text
 * }
 *
 * @method fuga() {
 *     {@internaltag1}
 *     text <@internaltag2> text
 * }
 *
 * @tagname1 tagvalue1
 * @tagname2 tagvalue21
 * @tagname2 tagvalue22
 */
', null, null);
        $this->assertEquals("this is description<tag_inline1 ></tag_inline1><tag_inline2 ></tag_inline2>

this is description1.
this is description2.
there is inline tag.<tag_inlinetag ></tag_inlinetag>
there is special tag.<tag_specialtag ></tag_specialtag>

- list1:    <tag_inlisttag1 ></tag_inlisttag1>
- list2:    <tag_inlisttag2 ></tag_inlisttag2>

", $comment['description']);

        $this->assertEquals(['inline1', 'inline2', 'inlinetag', 'specialtag', 'inlisttag1', 'inlisttag2', 'property', 'method', 'tagname1', 'tagname2'], array_keys($comment['tags']));
    }
}
