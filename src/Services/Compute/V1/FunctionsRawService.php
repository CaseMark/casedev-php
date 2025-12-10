<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\Compute\V1\Functions\FunctionGetLogsParams;
use Casedev\Compute\V1\Functions\FunctionListParams;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1\FunctionsRawContract;

final class FunctionsRawService implements FunctionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieves all serverless functions deployed in a specified compute environment. Functions can be used for custom document processing, AI model inference, or other computational tasks in legal workflows.
     *
     * @param array{env?: string}|FunctionListParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|FunctionListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = FunctionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'compute/v1/functions',
            query: $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Retrieve execution logs from a deployed serverless function. Logs include function output, errors, and runtime information. Useful for debugging and monitoring function performance in production.
     *
     * @param string $id The unique identifier of the function
     * @param array{tail?: int}|FunctionGetLogsParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getLogs(
        string $id,
        array|FunctionGetLogsParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FunctionGetLogsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['compute/v1/functions/%1$s/logs', $id],
            query: $parsed,
            options: $options,
            convert: null,
        );
    }
}
