<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Database;

use Casedev\Core\Exceptions\APIException;
use Casedev\Database\V1\V1GetUsageResponse;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
