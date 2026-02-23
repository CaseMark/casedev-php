<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Compute;

use Router\Compute\V1\V1GetUsageParams;
use Router\Compute\V1\V1GetUsageResponse;
use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
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
