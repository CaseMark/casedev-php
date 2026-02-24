<?php

declare(strict_types=1);

namespace CaseDev\Voice\V1\V1ListVoicesParams;

/**
 * Sort direction.
 */
enum SortDirection: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
