<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice\V1;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Voice\V1\Speak\SpeakCreateParams;

interface SpeakRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|SpeakCreateParams $params
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function create(
        array|SpeakCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
