<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Voice;

use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;
use Router\Voice\V1\V1ListVoicesParams;
use Router\Voice\V1\V1ListVoicesResponse;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
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
