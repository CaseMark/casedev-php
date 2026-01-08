<?php

declare(strict_types=1);

namespace Casedev\Services\Templates;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Templates\V1RawContract;
use Casedev\Templates\V1\V1ExecuteParams;
use Casedev\Templates\V1\V1ExecuteParams\Options;
use Casedev\Templates\V1\V1ExecuteResponse;
use Casedev\Templates\V1\V1ListParams;
use Casedev\Templates\V1\V1SearchParams;

/**
 * @phpstan-import-type OptionsShape from \Casedev\Templates\V1\V1ExecuteParams\Options
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve metadata for a published workflow by ID. Returns workflow configuration including input/output schemas, but excludes the prompt template for security.
     *
     * @param string $id Workflow ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['templates/v1/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
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
     *   subCategory?: string,
     *   type?: string,
     * }|V1ListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|V1ListParams $params,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = V1ListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'templates/v1',
            query: Util::array_transform_keys(
                $parsed,
                ['subCategory' => 'sub_category']
            ),
            options: $options,
            convert: null,
        );
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
     * @param string $id Unique identifier of the workflow to execute
     * @param array{
     *   input: mixed, options?: Options|OptionsShape
     * }|V1ExecuteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ExecuteResponse>
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        array|V1ExecuteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ExecuteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['templates/v1/%1$s/execute', $id],
            body: (object) $parsed,
            options: $options,
            convert: V1ExecuteResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieves the status and details of a workflow execution. This endpoint is designed for future asynchronous execution support and currently returns a 501 Not Implemented status since all executions are synchronous.
     *
     * @param string $id Unique identifier of the workflow execution
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['templates/v1/executions/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Perform semantic search across available workflows to find the most relevant pre-built document processing pipelines for your legal use case.
     *
     * @param array{
     *   query: string, category?: string, limit?: int
     * }|V1SearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function search(
        array|V1SearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1SearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'templates/v1/search',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }
}
