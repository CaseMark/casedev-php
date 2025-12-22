<?php

declare(strict_types=1);

namespace Casedev\Voice\Transcription\TranscriptionGetResponse;

/**
 * Current status of the transcription job.
 */
enum Status: string
{
    case QUEUED = 'queued';

    case PROCESSING = 'processing';

    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
