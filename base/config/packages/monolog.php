<?php

/*
 * This file is part of the RssBase project.
 * Copyright (c) Romain Gautier <romain@rssbase.io>
 * This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).
 */

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Config\MonologConfig;

return static function (MonologConfig $monolog, ContainerConfigurator $containerConfigurator): void {
    $monolog->channels(['deprecation']);

    if ('prod' === $containerConfigurator->env()) {
        $mainHandler = $monolog->handler('main')
            ->type('fingers_crossed')
            ->actionLevel('error')
            ->handler('nested')
            ->bufferSize(50);

        $mainHandler->excludedHttpCode()
            ->code(404);
        $mainHandler->excludedHttpCode()
            ->code(405);

        $monolog->handler('nested')
            ->type('stream')
            ->path('php://stderr')
            ->level('debug')
            ->formatter('monolog.formatter.json');

        $monolog->handler('console')
            ->type('console')
            ->processPsr3Messages(false)
            ->channels()
            ->elements(['!event', '!doctrine']);

        $monolog->handler('deprecation')
            ->type('stream')
            ->path('php://stderr')
            ->channels()
            ->elements(['deprecation']);
    } elseif ('dev' === $containerConfigurator->env()) {
        $monolog->handler('main')
            ->type('stream')
            ->path('%kernel.logs_dir%/%kernel.environment%.log')
            ->level('debug')
            ->channels()
            ->elements(['!event']);

        $monolog->handler('console')
            ->type('console')
            ->processPsr3Messages(false)
            ->channels()
            ->elements(['!event', '!doctrine', '!console']);
    } elseif ('test' === $containerConfigurator->env()) {
        $mainHandler = $monolog->handler('main');
        $mainHandler
            ->type('fingers_crossed')
            ->actionLevel('error')
            ->handler('nested')
            ->channels()
            ->elements(['!event']);

        $mainHandler->excludedHttpCode()
            ->code(404);
        $mainHandler->excludedHttpCode()
            ->code(405);

        $monolog->handler('nested')
            ->type('stream')
            ->path('%kernel.logs_dir%/%kernel.environment%.log')
            ->level('debug');
    }
};
