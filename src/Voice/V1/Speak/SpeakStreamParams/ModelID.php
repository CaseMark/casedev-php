<?php

declare(strict_types=1);

namespace Casedev\Voice\V1\Speak\SpeakStreamParams;

/**
 * TTS model to use.
 */
enum ModelID: string
{
    case ELEVEN_MONOLINGUAL_V1 = 'eleven_monolingual_v1';

    case ELEVEN_MULTILINGUAL_V1 = 'eleven_multilingual_v1';

    case ELEVEN_MULTILINGUAL_V2 = 'eleven_multilingual_v2';

    case ELEVEN_TURBO_V2 = 'eleven_turbo_v2';
}
