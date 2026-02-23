<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Compute\V1;

use Router\Compute\V1\InstanceTypes\InstanceTypeListResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
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
