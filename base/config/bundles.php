<?php

/*
 * This file is part of the RssBase project.
 * Copyright (c) Romain Gautier <romain@rssbase.io>
 * This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).
 */

declare(strict_types=1);

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => [
        'all' => true,
    ],
    Symfony\Bundle\TwigBundle\TwigBundle::class => [
        'all' => true,
    ],
    Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class => [
        'dev' => true,
        'test' => true,
    ],
    Symfony\Bundle\MonologBundle\MonologBundle::class => [
        'all' => true,
    ],
    Symfony\Bundle\DebugBundle\DebugBundle::class => [
        'dev' => true,
    ],
    Symfony\Bundle\MakerBundle\MakerBundle::class => [
        'dev' => true,
    ],
    Twig\Extra\TwigExtraBundle\TwigExtraBundle::class => [
        'all' => true,
    ],
];
