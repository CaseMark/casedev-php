<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1\V1ExecuteResponse;

enum Status: string
{
    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
