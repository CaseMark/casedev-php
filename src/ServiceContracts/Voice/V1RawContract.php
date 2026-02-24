<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Voice;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Voice\V1\V1ListVoicesParams;
use CaseDev\Voice\V1\V1ListVoicesResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
