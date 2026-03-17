<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1SecFilingParams;

/**
 * Run a full-text search or fetch a single entity filing history.
 */
enum Type: string
{
    case SEARCH = 'search';

    case ENTITY = 'entity';
}
