<?php

declare(strict_types=1);

namespace Casedev\Convert\V1\V1ProcessResponse;

/**
 * Current status of the conversion job.
 */
enum Status: string
{
    case QUEUED = 'queued';

    case PROCESSING = 'processing';

    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
