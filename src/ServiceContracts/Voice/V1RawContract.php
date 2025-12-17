<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Voice\V1\V1ListVoicesParams;

interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1ListVoicesParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listVoices(
        array|V1ListVoicesParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
