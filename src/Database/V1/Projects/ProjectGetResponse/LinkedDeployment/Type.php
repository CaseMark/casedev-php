<?php

declare(strict_types=1);

namespace Casedev\Database\V1\Projects\ProjectGetResponse\LinkedDeployment;

/**
 * Deployment type.
 */
enum Type: string
{
    case THURGOOD = 'thurgood';

    case COMPUTE = 'compute';
}
