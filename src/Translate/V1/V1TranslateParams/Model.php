<?php

declare(strict_types=1);

namespace Router\Translate\V1\V1TranslateParams;

/**
 * Translation model. 'nmt' (Neural Machine Translation) is recommended for quality.
 */
enum Model: string
{
    case NMT = 'nmt';

    case BASE = 'base';
}
