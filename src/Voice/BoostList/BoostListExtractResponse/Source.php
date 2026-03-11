<?php

declare(strict_types=1);

namespace CaseDev\Voice\BoostList\BoostListExtractResponse;

enum Source: string
{
    case DOCUMENT = 'document';

    case TEXT = 'text';
}
