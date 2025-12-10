<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Compute\V1\Invoke\InvokeRunParams;
use Casedev\Compute\V1\Invoke\InvokeRunResponse\AsynchronousResponse;
use Casedev\Compute\V1\Invoke\InvokeRunResponse\SynchronousResponse;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface InvokeRawContract
{
    /**
     * @api
     *
     * @param string $functionID Function ID or name to invoke
     * @param array<mixed>|InvokeRunParams $params
     *
     * @return BaseResponse<SynchronousResponse|AsynchronousResponse>
     *
     * @throws APIException
     */
    public function run(
        string $functionID,
        array|InvokeRunParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
