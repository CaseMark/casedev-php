<?php

declare(strict_types=1);

namespace Casedev\Services\Workflows;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Workflows\V1RawContract;
use Casedev\Workflows\V1\V1CreateParams;
use Casedev\Workflows\V1\V1CreateParams\TriggerType;
use Casedev\Workflows\V1\V1CreateParams\Visibility;
use Casedev\Workflows\V1\V1DeleteResponse;
use Casedev\Workflows\V1\V1DeployResponse;
use Casedev\Workflows\V1\V1ExecuteParams;
use Casedev\Workflows\V1\V1ExecuteResponse;
use Casedev\Workflows\V1\V1GetExecutionResponse;
use Casedev\Workflows\V1\V1GetResponse;
use Casedev\Workflows\V1\V1ListExecutionsParams;
use Casedev\Workflows\V1\V1ListExecutionsParams\Status;
use Casedev\Workflows\V1\V1ListExecutionsResponse;
use Casedev\Workflows\V1\V1ListParams;
use Casedev\Workflows\V1\V1ListResponse;
use Casedev\Workflows\V1\V1NewResponse;
use Casedev\Workflows\V1\V1UndeployResponse;
use Casedev\Workflows\V1\V1UpdateParams;
use Casedev\Workflows\V1\V1UpdateResponse;

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
     * Create a new visual workflow with nodes, edges, and trigger configuration.
     *
     * @param array{
     *   name: string,
     *   description?: string,
     *   edges?: list<mixed>,
     *   nodes?: list<mixed>,
     *   triggerConfig?: mixed,
     *   triggerType?: 'manual'|'webhook'|'schedule'|'vault_upload'|TriggerType,
     *   visibility?: 'private'|'org'|'public'|Visibility,
     * }|V1CreateParams $params
     *
     * @return BaseResponse<V1NewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|V1CreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = V1CreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'workflows/v1',
            body: (object) $parsed,
            options: $options,
            convert: V1NewResponse::class,
        );
    }

    /**
     * @api
     *
     * Get a specific workflow by ID with full configuration.
     *
     * @param string $id Workflow ID
     *
     * @return BaseResponse<V1GetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['workflows/v1/%1$s', $id],
            options: $requestOptions,
            convert: V1GetResponse::class,
        );
    }

    /**
     * @api
     *
     * Update an existing workflow's configuration.
     *
     * @param string $id Workflow ID
     * @param array{
     *   description?: string,
     *   edges?: list<mixed>,
     *   name?: string,
     *   nodes?: list<mixed>,
     *   triggerConfig?: mixed,
     *   triggerType?: 'manual'|'webhook'|'schedule'|'vault_upload'|V1UpdateParams\TriggerType,
     *   visibility?: 'private'|'org'|'public'|V1UpdateParams\Visibility,
     * }|V1UpdateParams $params
     *
     * @return BaseResponse<V1UpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|V1UpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1UpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['workflows/v1/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: V1UpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * List all workflows for the authenticated organization.
     *
     * @param array{
     *   limit?: int,
     *   offset?: int,
     *   visibility?: 'private'|'org'|'public'|V1ListParams\Visibility,
     * }|V1ListParams $params
     *
     * @return BaseResponse<V1ListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|V1ListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = V1ListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'workflows/v1',
            query: $parsed,
            options: $options,
            convert: V1ListResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete a workflow and all associated data.
     *
     * @param string $id Workflow ID
     *
     * @return BaseResponse<V1DeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['workflows/v1/%1$s', $id],
            options: $requestOptions,
            convert: V1DeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Deploy a workflow to AWS Step Functions. Returns a webhook URL and secret for triggering the workflow.
     *
     * @param string $id Workflow ID
     *
     * @return BaseResponse<V1DeployResponse>
     *
     * @throws APIException
     */
    public function deploy(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['workflows/v1/%1$s/deploy', $id],
            options: $requestOptions,
            convert: V1DeployResponse::class,
        );
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
     * @param array{
     *   callbackHeaders?: mixed,
     *   callbackURL?: string,
     *   input?: mixed,
     *   timeout?: string,
     *   wait?: bool,
     * }|V1ExecuteParams $params
     *
     * @return BaseResponse<V1ExecuteResponse>
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        array|V1ExecuteParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ExecuteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['workflows/v1/%1$s/execute', $id],
            body: (object) $parsed,
            options: $options,
            convert: V1ExecuteResponse::class,
        );
    }

    /**
     * @api
     *
     * List all executions for a specific workflow.
     *
     * @param string $id Workflow ID
     * @param array{
     *   limit?: int,
     *   status?: 'pending'|'running'|'completed'|'failed'|'cancelled'|Status,
     * }|V1ListExecutionsParams $params
     *
     * @return BaseResponse<V1ListExecutionsResponse>
     *
     * @throws APIException
     */
    public function listExecutions(
        string $id,
        array|V1ListExecutionsParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ListExecutionsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['workflows/v1/%1$s/executions', $id],
            query: $parsed,
            options: $options,
            convert: V1ListExecutionsResponse::class,
        );
    }

    /**
     * @api
     *
     * Get detailed information about a workflow execution, including live Step Functions status.
     *
     * @param string $id Execution ID
     *
     * @return BaseResponse<V1GetExecutionResponse>
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['workflows/v1/executions/%1$s', $id],
            options: $requestOptions,
            convert: V1GetExecutionResponse::class,
        );
    }

    /**
     * @api
     *
     * Stop a deployed workflow and delete its Step Functions state machine.
     *
     * @param string $id Workflow ID
     *
     * @return BaseResponse<V1UndeployResponse>
     *
     * @throws APIException
     */
    public function undeploy(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['workflows/v1/%1$s/deploy', $id],
            options: $requestOptions,
            convert: V1UndeployResponse::class,
        );
    }
}
