<?php

declare(strict_types=1);

namespace Casedev\Services\Voice;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Voice\TranscriptionContract;
use Casedev\Voice\Transcription\TranscriptionCreateParams;
use Casedev\Voice\Transcription\TranscriptionGetResponse;

final class TranscriptionService implements TranscriptionContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates an asynchronous transcription job for audio files. Supports various audio formats and advanced features like speaker identification, content moderation, and automatic highlights. Returns a job ID for checking transcription status and retrieving results.
     *
     * @param array{
     *   audio_url: string,
     *   auto_highlights?: bool,
     *   content_safety_labels?: bool,
     *   format_text?: bool,
     *   language_code?: string,
     *   language_detection?: bool,
     *   punctuate?: bool,
     *   speaker_labels?: bool,
     * }|TranscriptionCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|TranscriptionCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = TranscriptionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'voice/transcription',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Retrieve the status and result of an audio transcription job. Returns the transcription text when complete, or status information for pending jobs.
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): TranscriptionGetResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['voice/transcription/%1$s', $id],
            options: $requestOptions,
            convert: TranscriptionGetResponse::class,
        );
    }
}
