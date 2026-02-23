<?php

declare(strict_types=1);

namespace Router\Vault\Graphrag\GraphragGetStatsResponse;

/**
 * Current processing status.
 */
enum Status: string
{
    case PROCESSING = 'processing';

    case COMPLETED = 'completed';

    case ERROR = 'error';
}
