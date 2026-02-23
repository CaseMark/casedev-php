<?php

declare(strict_types=1);

namespace Router\Services\Applications\V1;

use Router\Applications\V1\Deployments\DeploymentCancelParams;
use Router\Applications\V1\Deployments\DeploymentCreateParams;
use Router\Applications\V1\Deployments\DeploymentCreateParams\Target;
use Router\Applications\V1\Deployments\DeploymentGetLogsParams;
use Router\Applications\V1\Deployments\DeploymentListParams;
use Router\Applications\V1\Deployments\DeploymentRetrieveParams;
use Router\Applications\V1\Deployments\DeploymentStreamParams;
use Router\Client;
use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\Core\Util;
use Router\RequestOptions;
use Router\ServiceContracts\Applications\V1\DeploymentsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
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
     * Trigger a new deployment for a project
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
     * Get details of a specific deployment including build logs
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
     * List deployments for a project
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
     * Cancel a running deployment
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
     * Get build logs for a specific deployment
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
     * Get the current status of a deployment
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
