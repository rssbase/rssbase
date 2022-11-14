<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude(['vendor', 'var'])
    ->in(__DIR__.'/../..')
;

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer' => true,
        '@Symfony' => true,
        '@PHP81Migration' => true,
        'no_alias_functions' => true,
        'global_namespace_import' => [
            'import_classes' => false,
            'import_constants' => false,
            'import_functions' => false,
        ],
    ])
    ->setFinder($finder)
;
