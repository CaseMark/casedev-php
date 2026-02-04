<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Database;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Database\V1\V1GetUsageResponse;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1GetUsageResponse>
     *
     * @throws APIException
     */
    public function getUsage(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
