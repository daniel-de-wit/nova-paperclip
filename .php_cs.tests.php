<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

require __DIR__ . '/vendor/autoload.php';

$finder = (new Finder())
    ->in(__DIR__ . '/tests')
    ->exclude('__snapshots__');

$config = require __DIR__ . '/.php_cs.common.php';

// Additional rules for tests
$config = array_merge(
    $config,
    [
        'declare_strict_types' => true,
    ]
);

return (new Config())
    ->setFinder($finder)
    ->setRules($config)
    ->setRiskyAllowed(true)
    ->setCacheFile(__DIR__ . '/.php_cs.tests.cache');
