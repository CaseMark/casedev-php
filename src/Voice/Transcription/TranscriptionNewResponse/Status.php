<?php

declare(strict_types=1);

namespace Router\Voice\Transcription\TranscriptionNewResponse;

/**
 * Current status of the transcription job.
 */
enum Status: string
{
    case QUEUED = 'queued';

    case PROCESSING = 'processing';

    case COMPLETED = 'completed';

    case ERROR = 'error';
}
