<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Projects\ProjectListDeploymentsParams;

/**
 * Deployment target to filter by.
 */
enum Target: string
{
    case PRODUCTION = 'production';

    case STAGING = 'staging';
}
