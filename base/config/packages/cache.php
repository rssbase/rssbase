<?php

/*
 * This file is part of the RssBase project.
 * Copyright (c) Romain Gautier <romain@rssbase.io>
 * This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).
 */

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

//use Symfony\Config\Framework\CacheConfig;

return static function (/*CacheConfig $cache, */ ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('framework', [
        'cache' => null,
    ]);
};
