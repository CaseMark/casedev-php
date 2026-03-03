<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1DocketParams;

/**
 * Search dockets or look up a docket by ID.
 */
enum Type: string
{
    case SEARCH = 'search';

    case LOOKUP = 'lookup';
}
