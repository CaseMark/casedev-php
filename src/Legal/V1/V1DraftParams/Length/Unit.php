<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1DraftParams\Length;

/**
 * Whether the target length is measured in words or pages.
 */
enum Unit: string
{
    case WORDS = 'words';

    case PAGES = 'pages';
}
