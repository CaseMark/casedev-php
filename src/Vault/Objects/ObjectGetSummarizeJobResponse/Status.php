<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects\ObjectGetSummarizeJobResponse;

/**
 * Current job status.
 */
enum Status: string
{
    case PENDING = 'pending';

    case PROCESSING = 'processing';

    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
