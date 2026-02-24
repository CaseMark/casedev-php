<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Projects\ProjectCreateDeploymentParams\EnvironmentVariable;

/**
 * Variable type.
 */
enum Type: string
{
    case PLAIN = 'plain';

    case ENCRYPTED = 'encrypted';

    case SECRET = 'secret';
}
