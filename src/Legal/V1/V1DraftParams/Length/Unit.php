<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1DraftParams\Length;

enum Unit: string
{
    case WORDS = 'words';

    case PAGES = 'pages';
}
