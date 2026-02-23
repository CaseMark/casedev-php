<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Database;

use Router\Core\Exceptions\APIException;
use Router\Database\V1\V1GetUsageResponse;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getUsage(
        RequestOptions|array|null $requestOptions = null
    ): V1GetUsageResponse;
}
