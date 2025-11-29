<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1\V1ExecuteParams\Options;

/**
 * Output format preference.
 */
enum Format: string
{
    case JSON = 'json';

    case TEXT = 'text';
}
