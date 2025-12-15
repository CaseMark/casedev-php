<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Voice\V1\Speak\SpeakCreateParams\ModelID;
use Casedev\Voice\V1\Speak\SpeakCreateParams\OutputFormat;

interface SpeakContract
{
    /**
     * @api
     *
     * @param string $text Text to convert to speech
     * @param bool $applyTextNormalization Apply automatic text normalization
     * @param bool $enableLogging Enable request logging
     * @param string $languageCode Language code for multilingual models
     * @param 'eleven_multilingual_v2'|'eleven_turbo_v2'|'eleven_monolingual_v1'|ModelID $modelID ElevenLabs model ID
     * @param string $nextText Next context for better pronunciation
     * @param int $optimizeStreamingLatency Optimize for streaming latency (0-4)
     * @param 'mp3_44100_128'|'mp3_44100_192'|'pcm_16000'|'pcm_22050'|'pcm_24000'|'pcm_44100'|OutputFormat $outputFormat Audio output format
     * @param string $previousText Previous context for better pronunciation
     * @param int $seed Seed for reproducible generation
     * @param string $voiceID ElevenLabs voice ID (defaults to Rachel - professional, clear)
     * @param array{
     *   similarityBoost?: float,
     *   stability?: float,
     *   style?: float,
     *   useSpeakerBoost?: bool,
     * } $voiceSettings Voice customization settings
     *
     * @throws APIException
     */
    public function create(
        string $text,
        bool $applyTextNormalization = true,
        bool $enableLogging = true,
        ?string $languageCode = null,
        string|ModelID $modelID = 'eleven_multilingual_v2',
        ?string $nextText = null,
        ?int $optimizeStreamingLatency = null,
        string|OutputFormat $outputFormat = 'mp3_44100_128',
        ?string $previousText = null,
        ?int $seed = null,
        string $voiceID = 'EXAVITQu4vr4xnSDxMaL',
        ?array $voiceSettings = null,
        ?RequestOptions $requestOptions = null,
    ): string;
}
