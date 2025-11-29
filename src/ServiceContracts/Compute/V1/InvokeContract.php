<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Compute\V1\Invoke\InvokeRunParams;
use Casedev\Compute\V1\Invoke\InvokeRunResponse\AsynchronousResponse;
use Casedev\Compute\V1\Invoke\InvokeRunResponse\SynchronousResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface InvokeContract
{
    /**
     * @api
     *
     * @param array<mixed>|InvokeRunParams $params
     *
     * @throws APIException
     */
    public function run(
        string $functionID,
        array|InvokeRunParams $params,
        ?RequestOptions $requestOptions = null,
    ): SynchronousResponse|AsynchronousResponse;
}
