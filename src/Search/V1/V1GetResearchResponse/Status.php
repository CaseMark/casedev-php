<?php

declare(strict_types=1);

namespace Router\Search\V1\V1GetResearchResponse;

/**
 * Current status of the research task.
 */
enum Status: string
{
    case PENDING = 'pending';

    case RUNNING = 'running';

    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
