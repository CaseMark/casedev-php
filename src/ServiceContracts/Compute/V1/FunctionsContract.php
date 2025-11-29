<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Compute\V1\Functions\FunctionGetLogsParams;
use Casedev\Compute\V1\Functions\FunctionListParams;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface FunctionsContract
{
    /**
     * @api
     *
     * @param array<mixed>|FunctionListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|FunctionListParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|FunctionGetLogsParams $params
     *
     * @throws APIException
     */
    public function getLogs(
        string $id,
        array|FunctionGetLogsParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
