<?php

declare(strict_types=1);

namespace Casedev\Services\Workflows;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Workflows\V1Contract;
use Casedev\Workflows\V1\V1CreateParams\TriggerType;
use Casedev\Workflows\V1\V1CreateParams\Visibility;
use Casedev\Workflows\V1\V1DeleteResponse;
use Casedev\Workflows\V1\V1DeployResponse;
use Casedev\Workflows\V1\V1ExecuteResponse;
use Casedev\Workflows\V1\V1GetExecutionResponse;
use Casedev\Workflows\V1\V1GetResponse;
use Casedev\Workflows\V1\V1ListExecutionsParams\Status;
use Casedev\Workflows\V1\V1ListExecutionsResponse;
use Casedev\Workflows\V1\V1ListResponse;
use Casedev\Workflows\V1\V1NewResponse;
use Casedev\Workflows\V1\V1UndeployResponse;
use Casedev\Workflows\V1\V1UpdateResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
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
     * Create a new visual workflow with nodes, edges, and trigger configuration.
     *
     * @param string $name Workflow name
     * @param string $description Workflow description
     * @param list<mixed> $edges React Flow edges
     * @param list<mixed> $nodes React Flow nodes
     * @param mixed $triggerConfig Trigger configuration
     * @param TriggerType|value-of<TriggerType> $triggerType
     * @param Visibility|value-of<Visibility> $visibility Workflow visibility
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?string $description = null,
        ?array $edges = null,
        ?array $nodes = null,
        mixed $triggerConfig = null,
        TriggerType|string $triggerType = 'webhook',
        Visibility|string $visibility = 'private',
        RequestOptions|array|null $requestOptions = null,
    ): V1NewResponse {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'description' => $description,
                'edges' => $edges,
                'nodes' => $nodes,
                'triggerConfig' => $triggerConfig,
                'triggerType' => $triggerType,
                'visibility' => $visibility,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a specific workflow by ID with full configuration.
     *
     * @param string $id Workflow ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): V1GetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update an existing workflow's configuration.
     *
     * @param string $id Workflow ID
     * @param list<mixed> $edges
     * @param list<mixed> $nodes
     * @param \Casedev\Workflows\V1\V1UpdateParams\TriggerType|value-of<\Casedev\Workflows\V1\V1UpdateParams\TriggerType> $triggerType
     * @param \Casedev\Workflows\V1\V1UpdateParams\Visibility|value-of<\Casedev\Workflows\V1\V1UpdateParams\Visibility> $visibility
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $description = null,
        ?array $edges = null,
        ?string $name = null,
        ?array $nodes = null,
        mixed $triggerConfig = null,
        \Casedev\Workflows\V1\V1UpdateParams\TriggerType|string|null $triggerType = null,
        \Casedev\Workflows\V1\V1UpdateParams\Visibility|string|null $visibility = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1UpdateResponse {
        $params = Util::removeNulls(
            [
                'description' => $description,
                'edges' => $edges,
                'name' => $name,
                'nodes' => $nodes,
                'triggerConfig' => $triggerConfig,
                'triggerType' => $triggerType,
                'visibility' => $visibility,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List all workflows for the authenticated organization.
     *
     * @param int $limit Maximum number of results
     * @param int $offset Offset for pagination
     * @param \Casedev\Workflows\V1\V1ListParams\Visibility|value-of<\Casedev\Workflows\V1\V1ListParams\Visibility> $visibility Filter by visibility
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        int $limit = 50,
        int $offset = 0,
        \Casedev\Workflows\V1\V1ListParams\Visibility|string|null $visibility = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1ListResponse {
        $params = Util::removeNulls(
            ['limit' => $limit, 'offset' => $offset, 'visibility' => $visibility]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a workflow and all associated data.
     *
     * @param string $id Workflow ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): V1DeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Deploy a workflow to AWS Step Functions. Returns a webhook URL and secret for triggering the workflow.
     *
     * @param string $id Workflow ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function deploy(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): V1DeployResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->deploy($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Execute a deployed workflow. Supports three modes:
     * - **Fire-and-forget** (default): Returns immediately with executionId. Poll /executions/{id} for status.
     * - **Callback**: Returns immediately, POSTs result to callbackUrl when workflow completes.
     * - **Sync wait**: Blocks until workflow completes (max 5 minutes).
     *
     * @param string $id Workflow ID
     * @param mixed $callbackHeaders Headers to include in callback request (e.g., Authorization)
     * @param string $callbackURL URL to POST results when workflow completes (enables callback mode)
     * @param mixed $input Input data to pass to the workflow
     * @param string $timeout Timeout for sync wait mode (e.g., '30s', '2m'). Max 5m. Default: 30s
     * @param bool $wait Wait for completion (default: false, max 5 min)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        mixed $callbackHeaders = null,
        ?string $callbackURL = null,
        mixed $input = null,
        ?string $timeout = null,
        ?bool $wait = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1ExecuteResponse {
        $params = Util::removeNulls(
            [
                'callbackHeaders' => $callbackHeaders,
                'callbackURL' => $callbackURL,
                'input' => $input,
                'timeout' => $timeout,
                'wait' => $wait,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->execute($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List all executions for a specific workflow.
     *
     * @param string $id Workflow ID
     * @param Status|value-of<Status> $status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listExecutions(
        string $id,
        int $limit = 20,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1ListExecutionsResponse {
        $params = Util::removeNulls(['limit' => $limit, 'status' => $status]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listExecutions($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get detailed information about a workflow execution, including live Step Functions status.
     *
     * @param string $id Execution ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): V1GetExecutionResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveExecution($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Stop a deployed workflow and delete its Step Functions state machine.
     *
     * @param string $id Workflow ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function undeploy(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): V1UndeployResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->undeploy($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
