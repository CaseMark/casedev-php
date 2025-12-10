<?php

declare(strict_types=1);

namespace Casedev\Services\Actions;

use Casedev\Actions\V1\V1CreateParams;
use Casedev\Actions\V1\V1ExecuteParams;
use Casedev\Actions\V1\V1ExecuteResponse;
use Casedev\Actions\V1\V1NewResponse;
use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Actions\V1RawContract;

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
     * Create a new action definition for multi-step workflow automation. Actions can be defined using YAML or JSON format and support complex workflows including document processing, data extraction, and analysis pipelines.
     *
     * @param array{
     *   definition: mixed|string,
     *   name: string,
     *   description?: string,
     *   webhookID?: string,
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
            path: 'actions/v1',
            body: (object) $parsed,
            options: $options,
            convert: V1NewResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a specific action definition by ID. Actions are reusable workflow components that can perform tasks like document analysis, data extraction, or API integrations. Only actions belonging to your organization can be accessed.
     *
     * @param string $id Unique identifier of the action definition
     *
     * @return BaseResponse<mixed>
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
            path: ['actions/v1/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Retrieve all action definitions for your organization. Actions are reusable automation components that can perform tasks like document processing, data extraction, and workflow execution.
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): BaseResponse
    {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'actions/v1',
            options: $requestOptions,
            convert: null
        );
    }

    /**
     * @api
     *
     * Permanently deletes an action definition from your organization. This will remove all workflow steps and configurations associated with the action. **Warning:** This operation cannot be undone.
     *
     * @param string $id Unique identifier of the action to delete
     *
     * @return BaseResponse<mixed>
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
            path: ['actions/v1/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Execute a multi-step action workflow with the provided input data. Actions can run synchronously (returning results immediately) or asynchronously (with webhook notifications when complete).
     *
     * @param string $id The unique identifier of the action to execute
     * @param array{
     *   input: array<string,mixed>, webhookID?: string
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
            path: ['actions/v1/%1$s/execute', $id],
            body: (object) $parsed,
            options: $options,
            convert: V1ExecuteResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve the status and results of a specific action execution. Returns execution details including current status, results, error messages, and execution metadata.
     *
     * @param string $id The unique identifier of the action execution
     *
     * @return BaseResponse<mixed>
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
            path: ['actions/v1/executions/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }
}
