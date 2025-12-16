<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Workflows;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
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

interface V1Contract
{
    /**
     * @api
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
    ): V1NewResponse;

    /**
     * @api
     *
     * @param string $id Workflow ID
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1GetResponse;

    /**
     * @api
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
    ): V1UpdateResponse;

    /**
     * @api
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
    ): V1ListResponse;

    /**
     * @api
     *
     * @param string $id Workflow ID
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1DeleteResponse;

    /**
     * @api
     *
     * @param string $id Workflow ID
     *
     * @throws APIException
     */
    public function deploy(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1DeployResponse;

    /**
     * @api
     *
     * @param string $id Workflow ID
     * @param mixed $callbackHeaders Headers to include in callback request (e.g., Authorization)
     * @param string $callbackURL URL to POST results when workflow completes (enables callback mode)
     * @param mixed $input Input data to pass to the workflow
     * @param string $timeout Timeout for sync wait mode (e.g., '30s', '2m'). Max 5m. Default: 30s
     * @param bool $wait Wait for completion (default: false, max 5 min)
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
        ?RequestOptions $requestOptions = null,
    ): V1ExecuteResponse;

    /**
     * @api
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
    ): V1ListExecutionsResponse;

    /**
     * @api
     *
     * @param string $id Execution ID
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1GetExecutionResponse;

    /**
     * @api
     *
     * @param string $id Workflow ID
     *
     * @throws APIException
     */
    public function undeploy(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1UndeployResponse;
}
