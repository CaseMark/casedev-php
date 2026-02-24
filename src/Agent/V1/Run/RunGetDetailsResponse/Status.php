<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunGetDetailsResponse;

enum Status: string
{
    case QUEUED = 'queued';

    case RUNNING = 'running';

    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';
}
