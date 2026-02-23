<?php

declare(strict_types=1);

namespace Router\Voice\Transcription\TranscriptionCreateParams;

/**
 * Output format for the transcript when using vault mode.
 */
enum Format: string
{
    case JSON = 'json';

    case TEXT = 'text';
}
