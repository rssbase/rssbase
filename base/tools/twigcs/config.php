<?php

/*
 * This file is part of the RssBase project.
 * Copyright (c) Romain Gautier <romain@rssbase.io>
 * This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).
 */

declare(strict_types=1);

return \FriendsOfTwig\Twigcs\Config\Config::create()
    ->setRuleSet(FriendsOfTwig\Twigcs\Ruleset\Official::class)
    ->addFinder(\FriendsOfTwig\Twigcs\Finder\TemplateFinder::create()->in(__DIR__ . '/../../templates'))
;
