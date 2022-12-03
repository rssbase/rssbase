<?php

/*
 * This file is part of the RssBase project.
 * Copyright (c) Romain Gautier <romain@rssbase.io>
 * This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).
 */

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routingConfigurator): void {
    if ('dev' === $routingConfigurator->env()) {
        $routingConfigurator->import(resource: '@WebProfilerBundle/Resources/config/routing/wdt.xml')
            ->prefix('/_wdt')
        ;
        $routingConfigurator->import(resource: '@WebProfilerBundle/Resources/config/routing/profiler.xml')
            ->prefix('/_profiler')
        ;
    }
};
