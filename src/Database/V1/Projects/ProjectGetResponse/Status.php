<?php

declare(strict_types=1);

namespace Casedev\Database\V1\Projects\ProjectGetResponse;

/**
 * Project status.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case SUSPENDED = 'suspended';

    case DELETED = 'deleted';
}
