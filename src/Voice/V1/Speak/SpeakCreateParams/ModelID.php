<?php

declare(strict_types=1);

namespace Router\Voice\V1\Speak\SpeakCreateParams;

/**
 * ElevenLabs model ID.
 */
enum ModelID: string
{
    case ELEVEN_MULTILINGUAL_V2 = 'eleven_multilingual_v2';

    case ELEVEN_TURBO_V2 = 'eleven_turbo_v2';

    case ELEVEN_MONOLINGUAL_V1 = 'eleven_monolingual_v1';
}
