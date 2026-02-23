<?php

declare(strict_types=1);

namespace Router\Services\Applications\V1;

use Router\Applications\V1\Deployments\DeploymentCreateParams\Target;
use Router\Client;
use Router\Core\Exceptions\APIException;
use Router\Core\Util;
use Router\RequestOptions;
use Router\ServiceContracts\Applications\V1\DeploymentsContract;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
final class DeploymentsService implements DeploymentsContract
{
    /**
     * @api
     */
    public DeploymentsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DeploymentsRawService($client);
    }

    /**
     * @api
     *
     * Trigger a new deployment for a project
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
    ): mixed {
        $params = Util::removeNulls(
            ['projectID' => $projectID, 'ref' => $ref, 'target' => $target]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get details of a specific deployment including build logs
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
    ): mixed {
        $params = Util::removeNulls(
            ['projectID' => $projectID, 'includeLogs' => $includeLogs]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List deployments for a project
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'projectID' => $projectID,
                'limit' => $limit,
                'state' => $state,
                'target' => $target,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a running deployment
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
    ): mixed {
        $params = Util::removeNulls(['projectID' => $projectID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create a deployment from raw file contents (for Thurgood sandbox deployments)
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createFromFiles(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createFromFiles(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get build logs for a specific deployment
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
    ): mixed {
        $params = Util::removeNulls(['projectID' => $projectID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getLogs($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the current status of a deployment
     *
     * @param string $id Deployment ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStatus(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getStatus($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Stream real-time deployment progress events via Server-Sent Events
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
    ): mixed {
        $params = Util::removeNulls(
            ['projectID' => $projectID, 'startIndex' => $startIndex]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->stream($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
