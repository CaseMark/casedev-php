<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1\FunctionsContract;

final class FunctionsService implements FunctionsContract
{
    /**
     * @api
     */
    public FunctionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FunctionsRawService($client);
    }

    /**
     * @api
     *
     * Retrieves all serverless functions deployed in a specified compute environment. Functions can be used for custom document processing, AI model inference, or other computational tasks in legal workflows.
     *
     * @param string $env Environment name. If not specified, uses the default environment.
     *
     * @throws APIException
     */
    public function list(
        ?string $env = null,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['env' => $env];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve execution logs from a deployed serverless function. Logs include function output, errors, and runtime information. Useful for debugging and monitoring function performance in production.
     *
     * @param string $id The unique identifier of the function
     * @param int $tail Number of log lines to retrieve (default 200, max 1000)
     *
     * @throws APIException
     */
    public function getLogs(
        string $id,
        int $tail = 200,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['tail' => $tail];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getLogs($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
