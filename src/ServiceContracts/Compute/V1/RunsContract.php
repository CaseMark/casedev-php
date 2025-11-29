<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Compute\V1\Runs\RunListParams;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface RunsContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|RunListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|RunListParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
