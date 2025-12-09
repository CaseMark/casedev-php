<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\Compute\V1\Invoke\InvokeRunParams;
use Casedev\Compute\V1\Invoke\InvokeRunResponse;
use Casedev\Compute\V1\Invoke\InvokeRunResponse\AsynchronousResponse;
use Casedev\Compute\V1\Invoke\InvokeRunResponse\SynchronousResponse;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1\InvokeContract;

final class InvokeService implements InvokeContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Execute a deployed compute function with custom input data. Supports both synchronous and asynchronous execution modes. Functions can be invoked by ID or name and can process various types of input data for legal document analysis, data processing, or other computational tasks.
     *
     * @param array{
     *   input: array<string,mixed>,
     *   async?: bool,
     *   functionSuffix?: '_modal'|'_task'|'_web'|'_server',
     * }|InvokeRunParams $params
     *
     * @throws APIException
     */
    public function run(
        string $functionID,
        array|InvokeRunParams $params,
        ?RequestOptions $requestOptions = null,
    ): SynchronousResponse|AsynchronousResponse {
        [$parsed, $options] = InvokeRunParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<SynchronousResponse|AsynchronousResponse> */
        $response = $this->client->request(
            method: 'post',
            path: ['compute/v1/invoke/%1$s', $functionID],
            body: (object) $parsed,
            options: $options,
            convert: InvokeRunResponse::class,
        );

        return $response->parse();
    }
}
