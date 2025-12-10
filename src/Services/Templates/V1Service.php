<?php

declare(strict_types=1);

namespace Casedev\Services\Templates;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Templates\V1Contract;
use Casedev\Templates\V1\V1ExecuteParams\Options\Format;
use Casedev\Templates\V1\V1ExecuteResponse;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
    }

    /**
     * @api
     *
     * Retrieve metadata for a published workflow by ID. Returns workflow configuration including input/output schemas, but excludes the prompt template for security.
     *
     * @param string $id Workflow ID
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
     * Retrieve a paginated list of available workflows with optional filtering by category, subcategory, type, and publication status. Workflows are pre-built document processing pipelines optimized for legal use cases.
     *
     * @param string $category Filter workflows by category (e.g., 'legal', 'compliance', 'contract')
     * @param int $limit Maximum number of workflows to return
     * @param int $offset Number of workflows to skip for pagination
     * @param bool $published Include only published workflows
     * @param string $subCategory Filter workflows by subcategory (e.g., 'due-diligence', 'litigation', 'mergers')
     * @param string $type Filter workflows by type (e.g., 'document-review', 'contract-analysis', 'compliance-check')
     *
     * @throws APIException
     */
    public function list(
        ?string $category = null,
        int $limit = 50,
        int $offset = 0,
        bool $published = true,
        ?string $subCategory = null,
        ?string $type = null,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        $params = [
            'category' => $category,
            'limit' => $limit,
            'offset' => $offset,
            'published' => $published,
            'subCategory' => $subCategory,
            'type' => $type,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

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
     * @param string $id Unique identifier of the workflow to execute
     * @param mixed $input Input data for the workflow (structure varies by workflow type)
     * @param array{format?: 'json'|'text'|Format, model?: string} $options
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        mixed $input,
        ?array $options = null,
        ?RequestOptions $requestOptions = null,
    ): V1ExecuteResponse {
        $params = ['input' => $input, 'options' => $options];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->execute($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves the status and details of a workflow execution. This endpoint is designed for future asynchronous execution support and currently returns a 501 Not Implemented status since all executions are synchronous.
     *
     * @param string $id Unique identifier of the workflow execution
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveExecution($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Perform semantic search across available workflows to find the most relevant pre-built document processing pipelines for your legal use case.
     *
     * @param string $query Search query to find relevant workflows
     * @param string $category Optional category filter to narrow results
     * @param int $limit Maximum number of results to return (default: 10, max: 50)
     *
     * @throws APIException
     */
    public function search(
        string $query,
        ?string $category = null,
        int $limit = 10,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        $params = ['query' => $query, 'category' => $category, 'limit' => $limit];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
