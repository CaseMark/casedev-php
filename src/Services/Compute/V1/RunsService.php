<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1\RunsContract;

final class RunsService implements RunsContract
{
    /**
     * @api
     */
    public RunsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RunsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve detailed information about a specific compute function run, including execution status, input/output data, resource usage metrics, and cost information.
     *
     * @param string $id Unique identifier of the compute run
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of recent compute runs for your organization. Filter by environment or function, and limit the number of results returned. Useful for monitoring serverless function executions and tracking performance metrics.
     *
     * @param string $env Environment name to filter runs by
     * @param string $function Function name to filter runs by
     * @param int $limit Maximum number of runs to return (1-100, default: 50)
     *
     * @throws APIException
     */
    public function list(
        ?string $env = null,
        ?string $function = null,
        int $limit = 50,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            ['env' => $env, 'function' => $function, 'limit' => $limit]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
