<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Voice\Transcription\TranscriptionCreateParams;
use Casedev\Voice\Transcription\TranscriptionGetResponse;
use Casedev\Voice\Transcription\TranscriptionNewResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface TranscriptionRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|TranscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TranscriptionNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|TranscriptionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
