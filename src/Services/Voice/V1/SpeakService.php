<?php

declare(strict_types=1);

namespace Casedev\Services\Voice\V1;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Voice\V1\SpeakContract;
use Casedev\Voice\V1\Speak\SpeakCreateParams;
use Casedev\Voice\V1\Speak\SpeakCreateParams\OutputFormat;
use Casedev\Voice\V1\Speak\SpeakStreamParams;
use Casedev\Voice\V1\Speak\SpeakStreamParams\ModelID;

final class SpeakService implements SpeakContract
{
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
     *   apply_text_normalization?: bool,
     *   enable_logging?: bool,
     *   language_code?: string,
     *   model_id?: 'eleven_multilingual_v2'|'eleven_turbo_v2'|'eleven_monolingual_v1',
     *   next_text?: string,
     *   optimize_streaming_latency?: int,
     *   output_format?: value-of<OutputFormat>,
     *   previous_text?: string,
     *   seed?: int,
     *   voice_id?: string,
     *   voice_settings?: array{
     *     similarity_boost?: float,
     *     stability?: float,
     *     style?: float,
     *     use_speaker_boost?: bool,
     *   },
     * }|SpeakCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|SpeakCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): string {
        [$parsed, $options] = SpeakCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<string> */
        $response = $this->client->request(
            method: 'post',
            path: 'voice/v1/speak',
            headers: ['Accept' => 'audio/mpeg'],
            body: (object) $parsed,
            options: $options,
            convert: 'string',
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Convert text to speech using ElevenLabs AI voices with streaming for real-time playback. Returns audio data as an MP3 stream for immediate playback with minimal latency. Perfect for legal document narration, client presentations, or accessibility features.
     *
     * @param array{
     *   text: string,
     *   apply_text_normalization?: bool,
     *   enable_logging?: bool,
     *   language_code?: string,
     *   model_id?: value-of<ModelID>,
     *   next_text?: string,
     *   optimize_streaming_latency?: int,
     *   output_format?: 'mp3_44100_128'|'mp3_22050_32'|'pcm_16000'|'pcm_22050'|'pcm_24000'|'pcm_44100',
     *   previous_text?: string,
     *   seed?: int,
     *   voice_id?: string,
     *   voice_settings?: array{
     *     similarity_boost?: float,
     *     stability?: float,
     *     style?: float,
     *     use_speaker_boost?: bool,
     *   },
     * }|SpeakStreamParams $params
     *
     * @throws APIException
     */
    public function stream(
        array|SpeakStreamParams $params,
        ?RequestOptions $requestOptions = null
    ): string {
        [$parsed, $options] = SpeakStreamParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<string> */
        $response = $this->client->request(
            method: 'post',
            path: 'voice/v1/speak/stream',
            headers: ['Accept' => 'audio/mpeg'],
            body: (object) $parsed,
            options: $options,
            convert: 'string',
        );

        return $response->parse();
    }
}
