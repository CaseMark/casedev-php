<?php

declare(strict_types=1);

namespace Casedev\Projects\V1\V1ListEnvVarsParams;

enum Environment: string
{
    case PRODUCTION = 'production';

    case PREVIEW = 'preview';

    case DEVELOPMENT = 'development';

    case SHARED = 'shared';
}
