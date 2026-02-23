<?php

declare(strict_types=1);

namespace Router\Legal\V1\V1PatentSearchParams;

/**
 * Field to sort results by.
 */
enum SortBy: string
{
    case FILING_DATE = 'filingDate';

    case GRANT_DATE = 'grantDate';
}
