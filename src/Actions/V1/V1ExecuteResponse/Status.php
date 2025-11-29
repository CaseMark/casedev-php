<?php

declare(strict_types=1);

namespace Casedev\Actions\V1\V1ExecuteResponse;

/**
 * Current status of the execution.
 */
enum Status: string
{
    case COMPLETED = 'completed';

    case RUNNING = 'running';
}
