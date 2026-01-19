<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Voice\V1\V1ListVoicesParams;
use Casedev\Voice\V1\V1ListVoicesResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1ListVoicesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ListVoicesResponse>
     *
     * @throws APIException
     */
    public function listVoices(
        array|V1ListVoicesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
