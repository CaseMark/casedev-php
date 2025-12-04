<?php

declare(strict_types=1);

namespace Casedev\Services\Workflows;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Workflows\V1Contract;
use Casedev\Workflows\V1\V1CreateParams;
use Casedev\Workflows\V1\V1DeleteResponse;
use Casedev\Workflows\V1\V1DeployResponse;
use Casedev\Workflows\V1\V1ExecuteParams;
use Casedev\Workflows\V1\V1ExecuteResponse;
use Casedev\Workflows\V1\V1GetExecutionResponse;
use Casedev\Workflows\V1\V1GetResponse;
use Casedev\Workflows\V1\V1ListExecutionsParams;
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
     *   triggerType?: 'manual'|'webhook'|'schedule'|'vault_upload',
     *   visibility?: 'private'|'org'|'public',
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
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1GetResponse {
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
     * @param array{
     *   description?: string,
     *   edges?: list<mixed>,
     *   name?: string,
     *   nodes?: list<mixed>,
     *   triggerConfig?: mixed,
     *   triggerType?: 'manual'|'webhook'|'schedule'|'vault_upload',
     *   visibility?: 'private'|'org'|'public',
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
     *   limit?: int, offset?: int, visibility?: 'private'|'org'|'public'
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
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1DeleteResponse {
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
     * Deploy a workflow to Modal compute. Returns a webhook URL and secret for triggering the workflow.
     *
     * @throws APIException
     */
    public function deploy(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1DeployResponse {
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
     * Execute a workflow for testing. This runs the workflow synchronously without deployment.
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): V1ExecuteResponse {
        [$parsed, $options] = V1ExecuteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['workflows/v1/%1$s/execute', $id],
            body: $parsed['body'],
            options: $options,
            convert: V1ExecuteResponse::class,
        );
    }

    /**
     * @api
     *
     * List all executions for a specific workflow.
     *
     * @param array{
     *   limit?: int, status?: 'pending'|'running'|'completed'|'failed'|'cancelled'
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
     * Get detailed information about a workflow execution.
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1GetExecutionResponse {
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
     * Stop a deployed workflow and release its webhook URL.
     *
     * @throws APIException
     */
    public function undeploy(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1UndeployResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['workflows/v1/%1$s/deploy', $id],
            options: $requestOptions,
            convert: V1UndeployResponse::class,
        );
    }
}
