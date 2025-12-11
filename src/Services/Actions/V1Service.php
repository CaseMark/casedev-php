<?php

declare(strict_types=1);

namespace Casedev\Services\Actions;

use Casedev\Actions\V1\V1ExecuteResponse;
use Casedev\Actions\V1\V1NewResponse;
use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Actions\V1Contract;

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
     * Create a new action definition for multi-step workflow automation. Actions can be defined using YAML or JSON format and support complex workflows including document processing, data extraction, and analysis pipelines.
     *
     * @param mixed|string $definition Action definition in YAML string, JSON string, or JSON object format
     * @param string $name Unique name for the action
     * @param string $description Optional description of the action's purpose
     * @param string $webhookID Optional webhook endpoint ID for action completion notifications
     *
     * @throws APIException
     */
    public function create(
        mixed $definition,
        string $name,
        ?string $description = null,
        ?string $webhookID = null,
        ?RequestOptions $requestOptions = null,
    ): V1NewResponse {
        $params = Util::removeNulls(
            [
                'definition' => $definition,
                'name' => $name,
                'description' => $description,
                'webhookID' => $webhookID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a specific action definition by ID. Actions are reusable workflow components that can perform tasks like document analysis, data extraction, or API integrations. Only actions belonging to your organization can be accessed.
     *
     * @param string $id Unique identifier of the action definition
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
     * Retrieve all action definitions for your organization. Actions are reusable automation components that can perform tasks like document processing, data extraction, and workflow execution.
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): mixed
    {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Permanently deletes an action definition from your organization. This will remove all workflow steps and configurations associated with the action. **Warning:** This operation cannot be undone.
     *
     * @param string $id Unique identifier of the action to delete
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Execute a multi-step action workflow with the provided input data. Actions can run synchronously (returning results immediately) or asynchronously (with webhook notifications when complete).
     *
     * @param string $id The unique identifier of the action to execute
     * @param array<string,mixed> $input Input data for the action execution
     * @param string $webhookID Optional webhook endpoint ID to override the action's default webhook
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        array $input,
        ?string $webhookID = null,
        ?RequestOptions $requestOptions = null,
    ): V1ExecuteResponse {
        $params = Util::removeNulls(['input' => $input, 'webhookID' => $webhookID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->execute($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve the status and results of a specific action execution. Returns execution details including current status, results, error messages, and execution metadata.
     *
     * @param string $id The unique identifier of the action execution
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
}
