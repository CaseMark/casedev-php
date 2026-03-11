<?php

declare(strict_types=1);

namespace CaseDev\Services\Applications\V1;

use CaseDev\Applications\V1\Deployments\DeploymentCancelParams;
use CaseDev\Applications\V1\Deployments\DeploymentCreateParams;
use CaseDev\Applications\V1\Deployments\DeploymentCreateParams\Target;
use CaseDev\Applications\V1\Deployments\DeploymentGetLogsParams;
use CaseDev\Applications\V1\Deployments\DeploymentListParams;
use CaseDev\Applications\V1\Deployments\DeploymentRetrieveParams;
use CaseDev\Applications\V1\Deployments\DeploymentStreamParams;
use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Applications\V1\DeploymentsRawContract;

/**
 * Web application deployment management.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class DeploymentsRawService implements DeploymentsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a deployment for an existing project by fetching repository files from GitHub and uploading them to the hosting provider. Use ref to deploy a branch, tag, or commit other than the project default branch.
     *
     * @param array{
     *   projectID: string, ref?: string, target?: Target|value-of<Target>
     * }|DeploymentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|DeploymentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeploymentCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'applications/v1/deployments',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Returns deployment details for one project in the authenticated organization. Set includeLogs=true to include recent build output in the response.
     *
     * @param string $id Deployment ID
     * @param array{
     *   projectID: string, includeLogs?: bool
     * }|DeploymentRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        array|DeploymentRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeploymentRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['applications/v1/deployments/%1$s', $id],
            query: Util::array_transform_keys($parsed, ['projectID' => 'projectId']),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Lists recent deployments for one project in the authenticated organization. Use the optional filters to narrow results by target or deployment state.
     *
     * @param array{
     *   projectID: string,
     *   limit?: float,
     *   state?: string,
     *   target?: DeploymentListParams\Target|value-of<DeploymentListParams\Target>,
     * }|DeploymentListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|DeploymentListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeploymentListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'applications/v1/deployments',
            query: Util::array_transform_keys($parsed, ['projectID' => 'projectId']),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Cancels a running deployment after verifying that the referenced project belongs to the authenticated organization. Use this when a build is stuck, misconfigured, or no longer needed.
     *
     * @param string $id Deployment ID
     * @param array{projectID: string}|DeploymentCancelParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        array|DeploymentCancelParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeploymentCancelParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['applications/v1/deployments/%1$s/cancel', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Create a deployment from raw file contents (for Thurgood sandbox deployments)
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function createFromFiles(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'applications/v1/deployments/from-files',
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Returns build and runtime log events for a deployment after verifying access to the owning project. Use this when you need detailed output for a failed or in-progress build.
     *
     * @param string $id Deployment ID
     * @param array{projectID: string}|DeploymentGetLogsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getLogs(
        string $id,
        array|DeploymentGetLogsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeploymentGetLogsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['applications/v1/deployments/%1$s/logs', $id],
            query: Util::array_transform_keys($parsed, ['projectID' => 'projectId']),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Returns the current status of a deployment without fetching full build logs. Use this endpoint for lightweight polling while a deployment is building or waiting to become ready.
     *
     * @param string $id Deployment ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getStatus(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['applications/v1/deployments/%1$s/status', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Stream real-time deployment progress events via Server-Sent Events
     *
     * @param string $id Workflow run ID
     * @param array{
     *   projectID: string, startIndex?: float
     * }|DeploymentStreamParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function stream(
        string $id,
        array|DeploymentStreamParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeploymentStreamParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['applications/v1/deployments/%1$s/stream', $id],
            query: Util::array_transform_keys($parsed, ['projectID' => 'projectId']),
            options: $options,
            convert: null,
        );
    }
}
