<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface V1Contract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function getPricing(?RequestOptions $requestOptions = null): mixed;

    /**
     * @api
     *
     * @param int $month Month to filter usage data (1-12, defaults to current month)
     * @param int $year Year to filter usage data (defaults to current year)
     *
     * @throws APIException
     */
    public function getUsage(
        ?int $month = null,
        ?int $year = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
