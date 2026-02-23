<?php

declare(strict_types=1);

namespace Router\Voice\Transcription\TranscriptionCreateParams;

/**
 * How much to boost custom vocabulary.
 */
enum BoostParam: string
{
    case LOW = 'low';

    case DEFAULT = 'default';

    case HIGH = 'high';
}
