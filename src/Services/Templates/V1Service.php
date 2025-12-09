<?php

declare(strict_types=1);

namespace Casedev\Services\Templates;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Templates\V1Contract;
use Casedev\Templates\V1\V1ExecuteParams;
use Casedev\Templates\V1\V1ExecuteResponse;
use Casedev\Templates\V1\V1ListParams;
use Casedev\Templates\V1\V1SearchParams;

final class V1Service implements V1Contract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve metadata for a published workflow by ID. Returns workflow configuration including input/output schemas, but excludes the prompt template for security.
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
            path: ['templates/v1/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a paginated list of available workflows with optional filtering by category, subcategory, type, and publication status. Workflows are pre-built document processing pipelines optimized for legal use cases.
     *
     * @param array{
     *   category?: string,
     *   limit?: int,
     *   offset?: int,
     *   published?: bool,
     *   sub_category?: string,
     *   type?: string,
     * }|V1ListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|V1ListParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = V1ListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'get',
            path: 'templates/v1',
            query: $parsed,
            options: $options,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Execute a pre-built workflow with custom input data. Workflows automate common legal document processing tasks like contract analysis, due diligence reviews, and document classification.
     *
     * **Available Workflows:**
     * - Contract analysis and risk assessment
     * - Document classification and tagging
     * - Legal research and case summarization
     * - Due diligence document review
     * - Compliance checking and reporting
     *
     * @param array{
     *   input: mixed, options?: array{format?: 'json'|'text', model?: string}
     * }|V1ExecuteParams $params
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        array|V1ExecuteParams $params,
        ?RequestOptions $requestOptions = null,
    ): V1ExecuteResponse {
        [$parsed, $options] = V1ExecuteParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<V1ExecuteResponse> */
        $response = $this->client->request(
            method: 'post',
            path: ['templates/v1/%1$s/execute', $id],
            body: (object) $parsed,
            options: $options,
            convert: V1ExecuteResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves the status and details of a workflow execution. This endpoint is designed for future asynchronous execution support and currently returns a 501 Not Implemented status since all executions are synchronous.
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'get',
            path: ['templates/v1/executions/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Perform semantic search across available workflows to find the most relevant pre-built document processing pipelines for your legal use case.
     *
     * @param array{
     *   query: string, category?: string, limit?: int
     * }|V1SearchParams $params
     *
     * @throws APIException
     */
    public function search(
        array|V1SearchParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = V1SearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'post',
            path: 'templates/v1/search',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );

        return $response->parse();
    }
}
