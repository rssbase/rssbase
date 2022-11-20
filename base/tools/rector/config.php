<?php

/*
 * This file is part of the RssBase project.
 * Copyright (c) Romain Gautier <romain@rssbase.io>
 * This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).
 */

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Symfony\Rector\Class_\ChangeFileLoaderInExtensionAndKernelRector;
use Rector\Symfony\Set\SymfonySetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/../../config',
        __DIR__ . '/../../public',
        __DIR__ . '/../../src',
        __DIR__ . '/..',
    ]);
    $rectorConfig->skip([__DIR__ . '/../*/vendor/*']);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);
    $rectorConfig->ruleWithConfiguration(ChangeFileLoaderInExtensionAndKernelRector::class, [
        ChangeFileLoaderInExtensionAndKernelRector::FROM => 'yaml',
        ChangeFileLoaderInExtensionAndKernelRector::TO => 'php',
    ]);

    // define sets of rules
    $rectorConfig->sets([LevelSetList::UP_TO_PHP_81]);

    $rectorConfig->symfonyContainerXml(__DIR__ . '/../../var/cache/dev/App_KernelDevDebugContainer.xml');

    $rectorConfig->sets([
        SymfonySetList::SYMFONY_61,
        SymfonySetList::SYMFONY_CODE_QUALITY,
        SymfonySetList::SYMFONY_CONSTRUCTOR_INJECTION,
        PHPUnitSetList::PHPUNIT_90,
    ]);
};
