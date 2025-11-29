<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Invoke\InvokeRunResponse\AsynchronousResponse;

enum Status: string
{
    case RUNNING = 'running';
}
