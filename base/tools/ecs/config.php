<?php

/*
 * This file is part of the RssBase project.
 * Copyright (c) Romain Gautier <romain@rssbase.io>
 * This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).
 */

declare(strict_types=1);

use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use Symplify\CodingStandard\Fixer\Naming\StandardizeHereNowDocKeywordFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->paths([
        __DIR__ . '/../../config',
        __DIR__ . '/../../src',
        __DIR__ . '/../../tests',
        __DIR__ . '/../../tools',
    ]);
    $ecsConfig->skip([__DIR__ . '../../tools/*/vendor']);

    $ecsConfig->sets([
        SetList::CLEAN_CODE,
        SetList::SYMPLIFY,
        SetList::COMMON,
        SetList::PSR_12,
        SetList::DOCTRINE_ANNOTATIONS,
    ]);

    $ecsConfig->skip([StandardizeHereNowDocKeywordFixer::class]);

    $ecsConfig->parallel();

    $ecsConfig->ruleWithConfiguration(
        HeaderCommentFixer::class,
        [
            'location' => 'after_open',
            'comment_type' => HeaderCommentFixer::HEADER_COMMENT,
            'header' => <<<COPYRIGHT
                This file is part of the RssBase project.
                Copyright (c) Romain Gautier <romain@rssbase.io>
                This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).
                COPYRIGHT
        ]
    );
};
