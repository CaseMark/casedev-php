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
     * @param 'manual'|'webhook'|'schedule'|'vault_upload'|TriggerType $triggerType
     * @param 'private'|'org'|'public'|Visibility $visibility Workflow visibility
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?string $description = null,
        ?array $edges = null,
        ?array $nodes = null,
        mixed $triggerConfig = null,
        string|TriggerType $triggerType = 'webhook',
        string|Visibility $visibility = 'private',
        ?RequestOptions $requestOptions = null,
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
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
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
     * @param 'manual'|'webhook'|'schedule'|'vault_upload'|\Casedev\Workflows\V1\V1UpdateParams\TriggerType $triggerType
     * @param 'private'|'org'|'public'|\Casedev\Workflows\V1\V1UpdateParams\Visibility $visibility
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
        string|\Casedev\Workflows\V1\V1UpdateParams\TriggerType|null $triggerType = null,
        string|\Casedev\Workflows\V1\V1UpdateParams\Visibility|null $visibility = null,
        ?RequestOptions $requestOptions = null,
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
     * @param 'private'|'org'|'public'|\Casedev\Workflows\V1\V1ListParams\Visibility $visibility Filter by visibility
     *
     * @throws APIException
     */
    public function list(
        int $limit = 50,
        int $offset = 0,
        string|\Casedev\Workflows\V1\V1ListParams\Visibility|null $visibility = null,
        ?RequestOptions $requestOptions = null,
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
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1DeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Deploy a workflow to Modal compute. Returns a webhook URL and secret for triggering the workflow.
     *
     * @param string $id Workflow ID
     *
     * @throws APIException
     */
    public function deploy(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1DeployResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->deploy($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Execute a workflow for testing. This runs the workflow synchronously without deployment.
     *
     * @param string $id Workflow ID
     * @param mixed $body Input data to pass to the workflow trigger
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        mixed $body = null,
        ?RequestOptions $requestOptions = null
    ): V1ExecuteResponse {
        $params = Util::removeNulls(['body' => $body]);

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
     * @param 'pending'|'running'|'completed'|'failed'|'cancelled'|Status $status
     *
     * @throws APIException
     */
    public function listExecutions(
        string $id,
        int $limit = 20,
        string|Status|null $status = null,
        ?RequestOptions $requestOptions = null,
    ): V1ListExecutionsResponse {
        $params = Util::removeNulls(['limit' => $limit, 'status' => $status]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listExecutions($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get detailed information about a workflow execution.
     *
     * @param string $id Execution ID
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1GetExecutionResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveExecution($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Stop a deployed workflow and release its webhook URL.
     *
     * @param string $id Workflow ID
     *
     * @throws APIException
     */
    public function undeploy(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1UndeployResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->undeploy($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
