<?php
return function ($namespaces, $dst, $config) {
    $GLOBALS['config'] = array_replace([
        'cachekey'   => time(),
        'title'      => 'No Title',
        'frontpage'  => '',
        'menusize'   => 30,
        'source-map' => [],
    ], is_file($config) ? require $config : []);

    // レンダリングしてファイルに書き込んでその realpath を返すクロージャ
    $perform = function ($template, $vars, $outfile) {
        ob_start();
        call_user_func(function () {
            extract(func_get_arg(1));
            include func_get_arg(0);
        }, $template, $vars);
        file_put_contents($outfile, ob_get_clean());
        return realpath($outfile);
    };

    // ディレクトリ
    $indir = __DIR__;
    $outdir = $dst . '/html';
    @mkdir($outdir, 0777, true);

    // 共通的なファイル出力
    yield $perform("$indir/common.css", [], "$outdir/common.css");
    yield $perform("$indir/common.js", [], "$outdir/common.js");
    yield $perform("$indir/index.phtml", [], "$outdir/../index.html");
    yield $perform("$indir/menu.phtml", ['namespaces' => $namespaces], "$outdir/menu.html");

    // 名前空間単位
    $gen = function ($namespaces) use (&$gen, $outdir, $indir, $perform) {
        foreach ($namespaces as $elements) {
            $outfile = $outdir . '/' . str_replace('\\', '-', $elements['fqsen']);
            yield $perform("$indir/main-ns.phtml", ['namespace' => $elements['fqsen'], 'elements' => $elements], "$outfile\$namespace.html");
            foreach (['interfaces' => 'interface', 'traits' => 'trait', 'classes' => 'class'] as $types => $type) {
                foreach ($elements[$types] as $element) {
                    $outfile = $outdir . '/' . str_replace('\\', '-', $element['fqsen']);
                    yield $perform("$indir/main-ts.phtml", ['type' => $type, 'element' => $element], "$outfile\$typespace.html");
                }
            }
            foreach ($gen($elements['namespaces']) as $g) {
                yield $g;
            }
        }
    };
    yield from $gen($namespaces);
};
