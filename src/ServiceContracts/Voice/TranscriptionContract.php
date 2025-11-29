<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Voice\Transcription\TranscriptionCreateParams;
use Casedev\Voice\Transcription\TranscriptionGetResponse;

interface TranscriptionContract
{
    /**
     * @api
     *
     * @param array<mixed>|TranscriptionCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|TranscriptionCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): TranscriptionGetResponse;
}
