<?php

declare(strict_types=1);

namespace Casedev\Voice\V1\Speak\SpeakCreateParams;

/**
 * Audio output format.
 */
enum OutputFormat: string
{
    case MP3_44100_128 = 'mp3_44100_128';

    case MP3_44100_192 = 'mp3_44100_192';

    case PCM_16000 = 'pcm_16000';

    case PCM_22050 = 'pcm_22050';

    case PCM_24000 = 'pcm_24000';

    case PCM_44100 = 'pcm_44100';
}
