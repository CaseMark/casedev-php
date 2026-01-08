<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice\V1;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Voice\V1\Speak\SpeakCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface SpeakRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SpeakCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function create(
        array|SpeakCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
