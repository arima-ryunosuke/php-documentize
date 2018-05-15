<?php

require_once __DIR__ . '/../vendor/autoload.php';

$outdir = __DIR__ . '/../src/functions';
$expotion = \ryunosuke\Functions\Transporter::exportFunction('ryunosuke\\Documentize', false);
file_put_contents("$outdir/constants.php", $expotion['constant']);
file_put_contents("$outdir/functions.php", $expotion['function']);
