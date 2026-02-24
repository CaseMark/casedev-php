<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Compute;

use CaseDev\Compute\V1\V1GetUsageResponse;
use CaseDev\Core\Exceptions\APIException;
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
    public function getPricing(
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param int $month Month to filter usage data (1-12, defaults to current month)
     * @param int $year Year to filter usage data (defaults to current year)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getUsage(
        ?int $month = null,
        ?int $year = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1GetUsageResponse;
}
