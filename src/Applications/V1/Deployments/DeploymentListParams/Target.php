<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Deployments\DeploymentListParams;

/**
 * Deployment target to filter by.
 */
enum Target: string
{
    case PRODUCTION = 'production';

    case STAGING = 'staging';
}
