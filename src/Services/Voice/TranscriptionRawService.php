<?php

declare(strict_types=1);

namespace CaseDev\Services\Voice;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Voice\TranscriptionRawContract;
use CaseDev\Voice\Transcription\TranscriptionCreateParams;
use CaseDev\Voice\Transcription\TranscriptionCreateParams\BoostParam;
use CaseDev\Voice\Transcription\TranscriptionCreateParams\Format;
use CaseDev\Voice\Transcription\TranscriptionGetResponse;
use CaseDev\Voice\Transcription\TranscriptionNewResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
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
     * Creates an asynchronous transcription job for audio files. Supports two modes:
     *
     * **Vault-based (recommended)**: Pass `vault_id` and `object_id` to transcribe audio from your vault. The transcript will automatically be saved back to the vault when complete.
     *
     * **Direct URL (legacy)**: Pass `audio_url` for direct transcription without automatic storage.
     *
     * @param array{
     *   audioURL?: string,
     *   autoHighlights?: bool,
     *   boostParam?: BoostParam|value-of<BoostParam>,
     *   contentSafetyLabels?: bool,
     *   format?: Format|value-of<Format>,
     *   formatText?: bool,
     *   languageCode?: string,
     *   languageDetection?: bool,
     *   objectID?: string,
     *   punctuate?: bool,
     *   speakerLabels?: bool,
     *   speakersExpected?: int,
     *   speechModels?: list<string>,
     *   vaultID?: string,
     *   wordBoost?: list<string>,
     * }|TranscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TranscriptionNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|TranscriptionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
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
            convert: TranscriptionNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve the status and result of an audio transcription job. For vault-based jobs, returns status and result_object_id when complete. For legacy direct URL jobs, returns the full transcription data.
     *
     * @param string $id The transcription job ID (tr_xxx for vault-based, or AssemblyAI ID for legacy)
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TranscriptionGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['voice/transcription/%1$s', $id],
            options: $requestOptions,
            convert: TranscriptionGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Deletes a transcription job. For managed vault jobs (tr_*), also removes local job records and managed transcript result objects. Idempotent: returns success if already deleted.
     *
     * @param string $id Transcription ID (managed tr_* or direct provider ID)
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['voice/transcription/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }
}
