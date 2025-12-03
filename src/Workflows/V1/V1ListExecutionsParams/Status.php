<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1\V1ListExecutionsParams;

enum Status: string
{
    case PENDING = 'pending';

    case RUNNING = 'running';

    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';
}
