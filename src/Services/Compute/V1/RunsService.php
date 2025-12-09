<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\Compute\V1\Runs\RunListParams;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1\RunsContract;

final class RunsService implements RunsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve detailed information about a specific compute function run, including execution status, input/output data, resource usage metrics, and cost information.
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'get',
            path: ['compute/v1/runs/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of recent compute runs for your organization. Filter by environment or function, and limit the number of results returned. Useful for monitoring serverless function executions and tracking performance metrics.
     *
     * @param array{env?: string, function?: string, limit?: int}|RunListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|RunListParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = RunListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'get',
            path: 'compute/v1/runs',
            query: $parsed,
            options: $options,
            convert: null,
        );

        return $response->parse();
    }
}
