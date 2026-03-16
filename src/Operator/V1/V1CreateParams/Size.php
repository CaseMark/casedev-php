<?php

declare(strict_types=1);

namespace CaseDev\Operator\V1\V1CreateParams;

/**
 * Instance size.
 */
enum Size: string
{
    case SMALL = 'small';

    case MEDIUM = 'medium';

    case LARGE = 'large';
}
