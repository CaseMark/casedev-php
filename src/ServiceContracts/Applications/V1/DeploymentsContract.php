<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Applications\V1;

use Router\Applications\V1\Deployments\DeploymentCreateParams\Target;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface DeploymentsContract
{
    /**
     * @api
     *
     * @param string $projectID Project ID
     * @param string $ref Git ref (branch, tag, or commit) to deploy
     * @param Target|value-of<Target> $target Deployment target
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $projectID,
        ?string $ref = null,
        Target|string $target = 'production',
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Deployment ID
     * @param string $projectID Project ID (for authorization)
     * @param bool $includeLogs Include build logs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        string $projectID,
        bool $includeLogs = false,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $projectID Project ID
     * @param float $limit Maximum number of deployments to return
     * @param string $state Filter by deployment state
     * @param \Router\Applications\V1\Deployments\DeploymentListParams\Target|value-of<\Router\Applications\V1\Deployments\DeploymentListParams\Target> $target Filter by deployment target
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $projectID,
        float $limit = 20,
        ?string $state = null,
        \Router\Applications\V1\Deployments\DeploymentListParams\Target|string|null $target = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Deployment ID
     * @param string $projectID Project ID (for authorization)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        string $projectID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createFromFiles(
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $id Deployment ID
     * @param string $projectID Project ID (for authorization)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getLogs(
        string $id,
        string $projectID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Deployment ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStatus(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $id Workflow run ID
     * @param string $projectID Project ID (for authorization)
     * @param float $startIndex Resume stream from this index (for reconnection)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function stream(
        string $id,
        string $projectID,
        ?float $startIndex = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
