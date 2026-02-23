<?php

declare(strict_types=1);

namespace Router\Legal\V1\V1PatentSearchParams;

/**
 * Sort order (default desc, newest first).
 */
enum SortOrder: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
