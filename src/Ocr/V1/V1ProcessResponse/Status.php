<?php

declare(strict_types=1);

namespace Casedev\Ocr\V1\V1ProcessResponse;

/**
 * Current job status.
 */
enum Status: string
{
    case QUEUED = 'queued';

    case PROCESSING = 'processing';

    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
