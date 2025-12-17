<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Voice\Transcription\TranscriptionCreateParams;
use Casedev\Voice\Transcription\TranscriptionGetResponse;

interface TranscriptionRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|TranscriptionCreateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|TranscriptionCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
