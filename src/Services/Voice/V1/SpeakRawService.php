<?php

declare(strict_types=1);

namespace Router\Services\Voice\V1;

use Router\Client;
use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;
use Router\ServiceContracts\Voice\V1\SpeakRawContract;
use Router\Voice\V1\Speak\SpeakCreateParams;
use Router\Voice\V1\Speak\SpeakCreateParams\ModelID;
use Router\Voice\V1\Speak\SpeakCreateParams\OutputFormat;
use Router\Voice\V1\Speak\SpeakCreateParams\VoiceSettings;

/**
 * @phpstan-import-type VoiceSettingsShape from \Router\Voice\V1\Speak\SpeakCreateParams\VoiceSettings
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
final class SpeakRawService implements SpeakRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Convert text to natural-sounding audio using ElevenLabs voices. Ideal for creating audio summaries of legal documents, client presentations, or accessibility features. Supports multiple languages and voice customization.
     *
     * @param array{
     *   text: string,
     *   applyTextNormalization?: bool,
     *   enableLogging?: bool,
     *   languageCode?: string,
     *   modelID?: ModelID|value-of<ModelID>,
     *   nextText?: string,
     *   optimizeStreamingLatency?: int,
     *   outputFormat?: value-of<OutputFormat>,
     *   previousText?: string,
     *   seed?: int,
     *   voiceID?: string,
     *   voiceSettings?: VoiceSettings|VoiceSettingsShape,
     * }|SpeakCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function create(
        array|SpeakCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SpeakCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'voice/v1/speak',
            headers: ['Accept' => 'audio/mpeg'],
            body: (object) $parsed,
            options: $options,
            convert: 'string',
        );
    }
}
