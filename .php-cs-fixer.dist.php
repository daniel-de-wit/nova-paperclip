<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

require __DIR__ . '/vendor/autoload.php';

$finder = (new Finder())
    ->in(__DIR__)
    ->exclude('tests');

$config = require __DIR__ . '/.php_cs.common.php';

return (new Config())
    ->setFinder($finder)
    ->setRules($config)
    ->setRiskyAllowed(true)
    ->setCacheFile(__DIR__ . '/.php_cs.cache');
