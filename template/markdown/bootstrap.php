<?php
require_once __DIR__ . '/common.php';

return function ($dataarray, $dst, $config) {
    $outdir = $dst;
    @mkdir($outdir, 0777, true);

    $renderer = new Renderer(array_replace([
        'extension'  => 'md', // md で吐き出した後に html などに変換する場合、拡張子が md のままだと困ることがある
        'source-map' => [],
    ], $config));

    foreach ($renderer->render($dataarray['namespaces']) as $namespace => $markdown) {
        $outfile = $outdir . '/' . (rtrim(str_replace('\\', '-', $namespace), '-') ?: 'global') . '.md';
        file_put_contents($outfile, $markdown);
        yield realpath($outfile);
    }
};
