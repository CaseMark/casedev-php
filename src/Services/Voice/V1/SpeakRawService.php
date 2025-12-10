<?php

declare(strict_types=1);

namespace Casedev\Services\Voice\V1;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Voice\V1\SpeakRawContract;
use Casedev\Voice\V1\Speak\SpeakCreateParams;
use Casedev\Voice\V1\Speak\SpeakCreateParams\ModelID;
use Casedev\Voice\V1\Speak\SpeakCreateParams\OutputFormat;
use Casedev\Voice\V1\Speak\SpeakStreamParams;

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
     *   modelID?: 'eleven_multilingual_v2'|'eleven_turbo_v2'|'eleven_monolingual_v1'|ModelID,
     *   nextText?: string,
     *   optimizeStreamingLatency?: int,
     *   outputFormat?: value-of<OutputFormat>,
     *   previousText?: string,
     *   seed?: int,
     *   voiceID?: string,
     *   voiceSettings?: array{
     *     similarityBoost?: float,
     *     stability?: float,
     *     style?: float,
     *     useSpeakerBoost?: bool,
     *   },
     * }|SpeakCreateParams $params
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function create(
        array|SpeakCreateParams $params,
        ?RequestOptions $requestOptions = null
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

    /**
     * @api
     *
     * Convert text to speech using ElevenLabs AI voices with streaming for real-time playback. Returns audio data as an MP3 stream for immediate playback with minimal latency. Perfect for legal document narration, client presentations, or accessibility features.
     *
     * @param array{
     *   text: string,
     *   applyTextNormalization?: bool,
     *   enableLogging?: bool,
     *   languageCode?: string,
     *   modelID?: value-of<SpeakStreamParams\ModelID>,
     *   nextText?: string,
     *   optimizeStreamingLatency?: int,
     *   outputFormat?: 'mp3_44100_128'|'mp3_22050_32'|'pcm_16000'|'pcm_22050'|'pcm_24000'|'pcm_44100'|SpeakStreamParams\OutputFormat,
     *   previousText?: string,
     *   seed?: int,
     *   voiceID?: string,
     *   voiceSettings?: array{
     *     similarityBoost?: float,
     *     stability?: float,
     *     style?: float,
     *     useSpeakerBoost?: bool,
     *   },
     * }|SpeakStreamParams $params
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function stream(
        array|SpeakStreamParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = SpeakStreamParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'voice/v1/speak/stream',
            headers: ['Accept' => 'audio/mpeg'],
            body: (object) $parsed,
            options: $options,
            convert: 'string',
        );
    }
}
