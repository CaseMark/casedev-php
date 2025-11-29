<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Invoke\InvokeRunResponse\SynchronousResponse;

enum Status: string
{
    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
