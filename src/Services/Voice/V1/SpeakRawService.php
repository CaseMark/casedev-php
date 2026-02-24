<?php

declare(strict_types=1);

namespace CaseDev\Services\Voice\V1;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Voice\V1\SpeakRawContract;
use CaseDev\Voice\V1\Speak\SpeakCreateParams;
use CaseDev\Voice\V1\Speak\SpeakCreateParams\ModelID;
use CaseDev\Voice\V1\Speak\SpeakCreateParams\OutputFormat;
use CaseDev\Voice\V1\Speak\SpeakCreateParams\VoiceSettings;

/**
 * @phpstan-import-type VoiceSettingsShape from \CaseDev\Voice\V1\Speak\SpeakCreateParams\VoiceSettings
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
