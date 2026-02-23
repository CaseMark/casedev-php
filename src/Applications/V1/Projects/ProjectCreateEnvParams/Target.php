<?php

declare(strict_types=1);

namespace Router\Applications\V1\Projects\ProjectCreateEnvParams;

enum Target: string
{
    case PRODUCTION = 'production';

    case PREVIEW = 'preview';

    case DEVELOPMENT = 'development';
}
