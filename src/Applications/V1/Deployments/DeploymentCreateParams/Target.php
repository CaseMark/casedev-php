<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Deployments\DeploymentCreateParams;

/**
 * Deployment target.
 */
enum Target: string
{
    case PRODUCTION = 'production';

    case PREVIEW = 'preview';
}
