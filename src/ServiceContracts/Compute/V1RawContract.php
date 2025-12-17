<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute;

use Casedev\Compute\V1\V1GetUsageParams;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface V1RawContract
{
    /**
     * @api
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getPricing(
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1GetUsageParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getUsage(
        array|V1GetUsageParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
