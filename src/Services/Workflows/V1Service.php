<?php

declare(strict_types=1);

namespace Casedev\Services\Workflows;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Workflows\V1Contract;
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

final class V1Service implements V1Contract
{
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
     * @throws APIException
     */
    public function create(
        array|V1CreateParams $params,
        ?RequestOptions $requestOptions = null
    ): V1NewResponse {
        [$parsed, $options] = V1CreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<V1NewResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'workflows/v1',
            body: (object) $parsed,
            options: $options,
            convert: V1NewResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a specific workflow by ID with full configuration.
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1GetResponse {
        /** @var BaseResponse<V1GetResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['workflows/v1/%1$s', $id],
            options: $requestOptions,
            convert: V1GetResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Update an existing workflow's configuration.
     *
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
     * @throws APIException
     */
    public function update(
        string $id,
        array|V1UpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): V1UpdateResponse {
        [$parsed, $options] = V1UpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<V1UpdateResponse> */
        $response = $this->client->request(
            method: 'patch',
            path: ['workflows/v1/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: V1UpdateResponse::class,
        );

        return $response->parse();
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
     * @throws APIException
     */
    public function list(
        array|V1ListParams $params,
        ?RequestOptions $requestOptions = null
    ): V1ListResponse {
        [$parsed, $options] = V1ListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<V1ListResponse> */
        $response = $this->client->request(
            method: 'get',
            path: 'workflows/v1',
            query: $parsed,
            options: $options,
            convert: V1ListResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a workflow and all associated data.
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1DeleteResponse {
        /** @var BaseResponse<V1DeleteResponse> */
        $response = $this->client->request(
            method: 'delete',
            path: ['workflows/v1/%1$s', $id],
            options: $requestOptions,
            convert: V1DeleteResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Deploy a workflow to Modal compute. Returns a webhook URL and secret for triggering the workflow.
     *
     * @throws APIException
     */
    public function deploy(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1DeployResponse {
        /** @var BaseResponse<V1DeployResponse> */
        $response = $this->client->request(
            method: 'post',
            path: ['workflows/v1/%1$s/deploy', $id],
            options: $requestOptions,
            convert: V1DeployResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Execute a workflow for testing. This runs the workflow synchronously without deployment.
     *
     * @param array{body?: mixed}|V1ExecuteParams $params
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
            path: ['workflows/v1/%1$s/execute', $id],
            body: $parsed['body'],
            options: $options,
            convert: V1ExecuteResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * List all executions for a specific workflow.
     *
     * @param array{
     *   limit?: int,
     *   status?: 'pending'|'running'|'completed'|'failed'|'cancelled'|Status,
     * }|V1ListExecutionsParams $params
     *
     * @throws APIException
     */
    public function listExecutions(
        string $id,
        array|V1ListExecutionsParams $params,
        ?RequestOptions $requestOptions = null,
    ): V1ListExecutionsResponse {
        [$parsed, $options] = V1ListExecutionsParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<V1ListExecutionsResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['workflows/v1/%1$s/executions', $id],
            query: $parsed,
            options: $options,
            convert: V1ListExecutionsResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Get detailed information about a workflow execution.
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1GetExecutionResponse {
        /** @var BaseResponse<V1GetExecutionResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['workflows/v1/executions/%1$s', $id],
            options: $requestOptions,
            convert: V1GetExecutionResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Stop a deployed workflow and release its webhook URL.
     *
     * @throws APIException
     */
    public function undeploy(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1UndeployResponse {
        /** @var BaseResponse<V1UndeployResponse> */
        $response = $this->client->request(
            method: 'delete',
            path: ['workflows/v1/%1$s/deploy', $id],
            options: $requestOptions,
            convert: V1UndeployResponse::class,
        );

        return $response->parse();
    }
}
