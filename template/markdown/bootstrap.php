<?php
require_once __DIR__ . '/common.php';

return function ($dataarray, $dst, $config) {
    $outdir = $dst;
    @mkdir($outdir, 0777, true);

    $renderer = new Renderer(array_replace([
        'mode'       => 'nest',
        'extension'  => 'md', // md で吐き出した後に html などに変換する場合、拡張子が md のままだと困ることがある
        'source-map' => [],
    ], $config));

    $namespaces = $renderer->preprocess($dataarray['namespaces']);

    foreach ($renderer->render($namespaces) as $namespace => $markdown) {
        $outfile = $outdir . '/' . (rtrim(str_replace('\\', '-', $namespace), '-') ?: 'global') . '.md';
        if (!file_exists($outfile) || sha1_file($outfile) !== sha1($markdown)) {
            file_put_contents($outfile, $markdown);
        }
        yield realpath($outfile);
    }
};
