<?php

declare(strict_types=1);

namespace Router\Search\V1\V1SearchParams;

/**
 * Type of search to perform.
 */
enum Type: string
{
    case AUTO = 'auto';

    case SEARCH = 'search';

    case NEWS = 'news';
}
