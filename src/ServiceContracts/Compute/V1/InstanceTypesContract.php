<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Compute\V1\InstanceTypes\InstanceTypeListResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface InstanceTypesContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): InstanceTypeListResponse;
}
