<?php

use ryunosuke\Documentize\Utils\Arrays;
use ryunosuke\Documentize\Utils\FileSystem;

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
    FileSystem::file_list("$root/src"),
    FileSystem::file_list("$root/template"),
    FileSystem::file_list("$root/vendor/composer", $filter),
    FileSystem::file_list("$root/vendor/psr", $filter),
    FileSystem::file_list("$root/vendor/myclabs", $filter),
    FileSystem::file_list("$root/vendor/erusev", $filter),
    FileSystem::file_list("$root/vendor/symfony", $filter),
    [
        "$root/vendor/autoload.php",
        "$root/bin/documentize",
    ]
);

$phar = new \Phar($pharpath);
$phar->buildFromIterator(new ArrayIterator(Arrays::array_convert($files, function ($k, $v) use ($root) {
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
