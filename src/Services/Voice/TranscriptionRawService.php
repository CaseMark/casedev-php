<?php

declare(strict_types=1);

namespace Casedev\Services\Voice;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Voice\TranscriptionRawContract;
use Casedev\Voice\Transcription\TranscriptionCreateParams;
use Casedev\Voice\Transcription\TranscriptionGetResponse;

final class TranscriptionRawService implements TranscriptionRawContract
{
    // @phpstan-ignore-next-line
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
     *   audioURL: string,
     *   autoHighlights?: bool,
     *   contentSafetyLabels?: bool,
     *   formatText?: bool,
     *   languageCode?: string,
     *   languageDetection?: bool,
     *   punctuate?: bool,
     *   speakerLabels?: bool,
     * }|TranscriptionCreateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|TranscriptionCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TranscriptionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
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
     * @param string $id The transcription job ID returned from the create transcription endpoint
     *
     * @return BaseResponse<TranscriptionGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['voice/transcription/%1$s', $id],
            options: $requestOptions,
            convert: TranscriptionGetResponse::class,
        );
    }
}
