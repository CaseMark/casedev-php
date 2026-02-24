<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Compute;

use CaseDev\Compute\V1\V1GetUsageParams;
use CaseDev\Compute\V1\V1GetUsageResponse;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getPricing(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1GetUsageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1GetUsageResponse>
     *
     * @throws APIException
     */
    public function getUsage(
        array|V1GetUsageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
