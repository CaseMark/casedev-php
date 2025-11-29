<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Voice\V1\V1ListVoicesParams;

interface V1Contract
{
    /**
     * @api
     *
     * @param array<mixed>|V1ListVoicesParams $params
     *
     * @throws APIException
     */
    public function listVoices(
        array|V1ListVoicesParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
