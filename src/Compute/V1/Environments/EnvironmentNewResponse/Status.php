<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Environments\EnvironmentNewResponse;

/**
 * Environment status.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case INACTIVE = 'inactive';
}
