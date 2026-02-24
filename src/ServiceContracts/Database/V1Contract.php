<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Database;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\Database\V1\V1GetUsageResponse;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
