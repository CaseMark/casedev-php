<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Voice\V1;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Voice\V1\Speak\SpeakCreateParams\ModelID;
use CaseDev\Voice\V1\Speak\SpeakCreateParams\OutputFormat;
use CaseDev\Voice\V1\Speak\SpeakCreateParams\VoiceSettings;

/**
 * @phpstan-import-type VoiceSettingsShape from \CaseDev\Voice\V1\Speak\SpeakCreateParams\VoiceSettings
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface SpeakContract
{
    /**
     * @api
     *
     * @param string $text Text to convert to speech
     * @param bool $applyTextNormalization Apply automatic text normalization
     * @param bool $enableLogging Enable request logging
     * @param string $languageCode Language code for multilingual models
     * @param ModelID|value-of<ModelID> $modelID ElevenLabs model ID
     * @param string $nextText Next context for better pronunciation
     * @param int $optimizeStreamingLatency Optimize for streaming latency (0-4)
     * @param OutputFormat|value-of<OutputFormat> $outputFormat Audio output format
     * @param string $previousText Previous context for better pronunciation
     * @param int $seed Seed for reproducible generation
     * @param string $voiceID ElevenLabs voice ID (defaults to Rachel - professional, clear)
     * @param VoiceSettings|VoiceSettingsShape $voiceSettings Voice customization settings
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $text,
        bool $applyTextNormalization = true,
        bool $enableLogging = true,
        ?string $languageCode = null,
        ModelID|string $modelID = 'eleven_multilingual_v2',
        ?string $nextText = null,
        ?int $optimizeStreamingLatency = null,
        OutputFormat|string $outputFormat = 'mp3_44100_128',
        ?string $previousText = null,
        ?int $seed = null,
        string $voiceID = 'EXAVITQu4vr4xnSDxMaL',
        VoiceSettings|array|null $voiceSettings = null,
        RequestOptions|array|null $requestOptions = null,
    ): string;
}
