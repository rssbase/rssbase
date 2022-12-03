<?php

/*
 * This file is part of the RssBase project.
 * Copyright (c) Romain Gautier <romain@rssbase.io>
 * This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).
 */

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $framework, ContainerConfigurator $containerConfigurator): void {
    $framework->secret('%env(APP_SECRET)%');
    $framework->httpMethodOverride(false);

    $session = $framework->session();
    $session->handlerId(null);
    $session->cookieSecure('auto');
    $session->cookieSamesite('lax');
    $session->storageFactoryId('session.storage.factory.native');

    ($framework->phpErrors())
        ->log(true);

    if ('test' === $containerConfigurator->env()) {
        $framework->test(true);
        ($framework->session())
            ->storageFactoryId('session.storage.factory.mock_file');
    }
};
