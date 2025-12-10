<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Compute\V1\Invoke\InvokeRunParams\FunctionSuffix;
use Casedev\Compute\V1\Invoke\InvokeRunResponse\AsynchronousResponse;
use Casedev\Compute\V1\Invoke\InvokeRunResponse\SynchronousResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface InvokeContract
{
    /**
     * @api
     *
     * @param string $functionID Function ID or name to invoke
     * @param array<string,mixed> $input Input data to pass to the function
     * @param bool $async If true, returns immediately with run ID for background execution
     * @param '_modal'|'_task'|'_web'|'_server'|FunctionSuffix $functionSuffix Override the auto-detected function suffix
     *
     * @throws APIException
     */
    public function run(
        string $functionID,
        array $input,
        bool $async = false,
        string|FunctionSuffix|null $functionSuffix = null,
        ?RequestOptions $requestOptions = null,
    ): SynchronousResponse|AsynchronousResponse;
}
