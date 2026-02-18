<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\System\SystemListServicesResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
