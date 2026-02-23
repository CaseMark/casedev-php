<?php

declare(strict_types=1);

namespace Router\Database\V1\Projects\ProjectNewResponse;

/**
 * Project status.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case SUSPENDED = 'suspended';

    case DELETED = 'deleted';
}
