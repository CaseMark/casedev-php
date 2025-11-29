<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\V1DeployParams;

/**
 * Deployment type: task for batch jobs, service for web endpoints.
 */
enum Type: string
{
    case TASK = 'task';

    case SERVICE = 'service';
}
