<?php

declare(strict_types=1);

namespace Casedev\Convert\V1\V1WebhookParams;

/**
 * Status of the conversion job.
 */
enum Status: string
{
    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
