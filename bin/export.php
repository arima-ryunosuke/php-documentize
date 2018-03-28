<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/ryunosuke/functions/include/constant.php';

$filename = __DIR__ . '/../src/Utils/.constant.php';
$namespace = \ryunosuke\Functions\Package\Classobj::detect_namespace(dirname($filename));
$exportion = \ryunosuke\Functions\Transporter::exportFunction($namespace, true, dirname($filename));
file_put_contents($filename, $exportion['constant']);
touch($filename, max(array_map('filemtime', glob(__DIR__ . '/../src/Utils/*.php'))));
