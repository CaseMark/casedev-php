<?php

declare(strict_types=1);

namespace CaseDev\Voice\Transcription\TranscriptionCreateParams;

/**
 * How much to boost custom vocabulary.
 */
enum BoostParam: string
{
    case LOW = 'low';

    case DEFAULT = 'default';

    case HIGH = 'high';
}
