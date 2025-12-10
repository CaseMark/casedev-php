<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Actions;

use Casedev\Actions\V1\V1ExecuteResponse;
use Casedev\Actions\V1\V1NewResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface V1Contract
{
    /**
     * @api
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
    ): V1NewResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier of the action definition
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): mixed;

    /**
     * @api
     *
     * @param string $id Unique identifier of the action to delete
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): V1ExecuteResponse;

    /**
     * @api
     *
     * @param string $id The unique identifier of the action execution
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
