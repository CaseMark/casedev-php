<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Voice\V1;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Voice\V1\Speak\SpeakCreateParams;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
