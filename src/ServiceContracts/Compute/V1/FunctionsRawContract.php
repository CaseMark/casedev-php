<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Compute\V1\Functions\FunctionGetLogsParams;
use Casedev\Compute\V1\Functions\FunctionListParams;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface FunctionsRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|FunctionListParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|FunctionListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id The unique identifier of the function
     * @param array<mixed>|FunctionGetLogsParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getLogs(
        string $id,
        array|FunctionGetLogsParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
