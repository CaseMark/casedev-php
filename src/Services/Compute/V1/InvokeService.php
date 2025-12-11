<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\Compute\V1\Invoke\InvokeRunParams\FunctionSuffix;
use Casedev\Compute\V1\Invoke\InvokeRunResponse\AsynchronousResponse;
use Casedev\Compute\V1\Invoke\InvokeRunResponse\SynchronousResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1\InvokeContract;

final class InvokeService implements InvokeContract
{
    /**
     * @api
     */
    public InvokeRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InvokeRawService($client);
    }

    /**
     * @api
     *
     * Execute a deployed compute function with custom input data. Supports both synchronous and asynchronous execution modes. Functions can be invoked by ID or name and can process various types of input data for legal document analysis, data processing, or other computational tasks.
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
    ): SynchronousResponse|AsynchronousResponse {
        $params = Util::removeNulls(
            [
                'input' => $input,
                'async' => $async,
                'functionSuffix' => $functionSuffix,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->run($functionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
