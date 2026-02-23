<?php

declare(strict_types=1);

namespace Router\Applications\V1\Deployments\DeploymentListParams;

/**
 * Filter by deployment target.
 */
enum Target: string
{
    case PRODUCTION = 'production';

    case STAGING = 'staging';
}
