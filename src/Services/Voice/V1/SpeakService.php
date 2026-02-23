<?php

declare(strict_types=1);

namespace Router\Services\Voice\V1;

use Router\Client;
use Router\Core\Exceptions\APIException;
use Router\Core\Util;
use Router\RequestOptions;
use Router\ServiceContracts\Voice\V1\SpeakContract;
use Router\Voice\V1\Speak\SpeakCreateParams\ModelID;
use Router\Voice\V1\Speak\SpeakCreateParams\OutputFormat;
use Router\Voice\V1\Speak\SpeakCreateParams\VoiceSettings;

/**
 * @phpstan-import-type VoiceSettingsShape from \Router\Voice\V1\Speak\SpeakCreateParams\VoiceSettings
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
final class SpeakService implements SpeakContract
{
    /**
     * @api
     */
    public SpeakRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SpeakRawService($client);
    }

    /**
     * @api
     *
     * Convert text to natural-sounding audio using ElevenLabs voices. Ideal for creating audio summaries of legal documents, client presentations, or accessibility features. Supports multiple languages and voice customization.
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
    ): string {
        $params = Util::removeNulls(
            [
                'text' => $text,
                'applyTextNormalization' => $applyTextNormalization,
                'enableLogging' => $enableLogging,
                'languageCode' => $languageCode,
                'modelID' => $modelID,
                'nextText' => $nextText,
                'optimizeStreamingLatency' => $optimizeStreamingLatency,
                'outputFormat' => $outputFormat,
                'previousText' => $previousText,
                'seed' => $seed,
                'voiceID' => $voiceID,
                'voiceSettings' => $voiceSettings,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
