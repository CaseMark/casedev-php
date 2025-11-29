<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Vault;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface GraphragContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function getStats(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function init(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
