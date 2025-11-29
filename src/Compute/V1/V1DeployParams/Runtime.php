<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\V1DeployParams;

/**
 * Runtime environment.
 */
enum Runtime: string
{
    case PYTHON = 'python';

    case DOCKERFILE = 'dockerfile';

    case IMAGE = 'image';
}
