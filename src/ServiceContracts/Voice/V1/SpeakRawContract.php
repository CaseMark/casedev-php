<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Voice\V1;

use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;
use Router\Voice\V1\Speak\SpeakCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
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
