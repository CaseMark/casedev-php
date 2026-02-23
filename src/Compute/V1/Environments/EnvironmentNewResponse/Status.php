<?php

declare(strict_types=1);

namespace Router\Compute\V1\Environments\EnvironmentNewResponse;

/**
 * Environment status.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case INACTIVE = 'inactive';
}
