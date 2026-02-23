<?php

declare(strict_types=1);

namespace Router\ServiceContracts;

use Router\Core\Exceptions\APIException;
use Router\RequestOptions;
use Router\System\SystemListServicesResponse;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface SystemContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listServices(
        RequestOptions|array|null $requestOptions = null
    ): SystemListServicesResponse;
}
