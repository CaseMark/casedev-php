<?php

declare(strict_types=1);

namespace CaseDev\Database\V1\Projects\ProjectListResponse\Project\LinkedDeployment;

/**
 * Type of deployment.
 */
enum Type: string
{
    case COMPUTE = 'compute';
}
