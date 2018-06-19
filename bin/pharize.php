<?php

use function \ryunosuke\Documentize\file_list;
use function \ryunosuke\Documentize\array_convert;

require_once __DIR__ . "/../vendor/autoload.php";

$root = realpath(__DIR__ . "/../");
$pharpath = __DIR__ . "/../documentize.phar";
@unlink($pharpath);

$filter = function ($file) {
    if (preg_match('#tests#i', $file)) {
        return false;
    }
    if (!preg_match('#\.php$#i', $file)) {
        return false;
    }
    return true;
};
$files = array_merge(
    file_list("$root/src"),
    file_list("$root/template"),
    file_list("$root/vendor/composer", $filter),
    file_list("$root/vendor/psr", $filter),
    file_list("$root/vendor/paragonie", $filter),
    file_list("$root/vendor/myclabs", $filter),
    file_list("$root/vendor/cebe", $filter),
    file_list("$root/vendor/symfony", $filter),
    [
        "$root/vendor/autoload.php",
        "$root/bin/documentize",
    ]
);

$phar = new \Phar($pharpath);
$phar->buildFromIterator(new ArrayIterator(array_convert($files, function ($k, $v) use ($root) {
    return str_replace($root, '', $v);
})));
$phar->addFromString('bin/documentize', preg_replace('/^#!.*\s*/', '', file_get_contents("$root/bin/documentize")));
$phar->setStub(<<<STUB
#!/usr/bin/env php
<?php
require 'phar://' . __FILE__ . '/bin/documentize';
__HALT_COMPILER(); ?>
STUB
);
$phar->compressFiles(\Phar::GZ);

$timestamp = new \Seld\PharUtils\Timestamps($pharpath);
$timestamp->updateTimestamps(max(array_map('filemtime', $files)));
$timestamp->save($pharpath, \Phar::SHA512);
