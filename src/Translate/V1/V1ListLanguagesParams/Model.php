<?php

declare(strict_types=1);

namespace Casedev\Translate\V1\V1ListLanguagesParams;

/**
 * Translation model to check language support for.
 */
enum Model: string
{
    case NMT = 'nmt';

    case BASE = 'base';
}
