<?php

declare(strict_types=1);

namespace CaseDev\Voice\Transcription\TranscriptionRetrieveParams;

/**
 * Include full transcript text in response for vault-based jobs (default: false).
 */
enum IncludeText: string
{
    case TRUE = 'true';

    case FALSE = 'false';
}
