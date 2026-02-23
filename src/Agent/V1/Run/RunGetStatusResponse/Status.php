<?php

declare(strict_types=1);

namespace Router\Agent\V1\Run\RunGetStatusResponse;

enum Status: string
{
    case QUEUED = 'queued';

    case RUNNING = 'running';

    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';
}
