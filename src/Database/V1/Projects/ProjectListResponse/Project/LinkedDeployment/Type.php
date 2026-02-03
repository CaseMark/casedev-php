<?php

declare(strict_types=1);

namespace Casedev\Database\V1\Projects\ProjectListResponse\Project\LinkedDeployment;

/**
 * Type of deployment.
 */
enum Type: string
{
    case THURGOOD = 'thurgood';

    case COMPUTE = 'compute';
}
