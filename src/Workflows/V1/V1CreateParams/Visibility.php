<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1\V1CreateParams;

/**
 * Workflow visibility.
 */
enum Visibility: string
{
    case PRIVATE = 'private';

    case ORG = 'org';

    case PUBLIC = 'public';
}
