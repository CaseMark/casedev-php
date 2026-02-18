<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\System\SystemListServicesResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface SystemRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SystemListServicesResponse>
     *
     * @throws APIException
     */
    public function listServices(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
