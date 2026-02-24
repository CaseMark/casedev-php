<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Projects\ProjectCreateDeploymentParams\EnvironmentVariable;

enum Target: string
{
    case PRODUCTION = 'production';

    case PREVIEW = 'preview';

    case DEVELOPMENT = 'development';
}
