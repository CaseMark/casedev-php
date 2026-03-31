<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Execute\ExecuteNewResponse;

enum Status: string
{
    case RUNNING = 'running';

    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
