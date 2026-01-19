<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\Compute\V1\Environments\EnvironmentCreateParams;
use Casedev\Compute\V1\Environments\EnvironmentDeleteResponse;
use Casedev\Compute\V1\Environments\EnvironmentGetResponse;
use Casedev\Compute\V1\Environments\EnvironmentListResponse;
use Casedev\Compute\V1\Environments\EnvironmentNewResponse;
use Casedev\Compute\V1\Environments\EnvironmentSetDefaultResponse;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1\EnvironmentsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class EnvironmentsRawService implements EnvironmentsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a new compute environment for running serverless workloads. Each environment gets its own isolated namespace with a unique domain for hosting applications and APIs. The first environment created becomes the default environment for the organization.
     *
     * @param array{name: string}|EnvironmentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EnvironmentNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|EnvironmentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EnvironmentCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'compute/v1/environments',
            body: (object) $parsed,
            options: $options,
            convert: EnvironmentNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a specific compute environment by name. Returns environment configuration including status, domain, and metadata for your serverless compute infrastructure.
     *
     * @param string $name The name of the compute environment to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EnvironmentGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $name,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['compute/v1/environments/%1$s', $name],
            options: $requestOptions,
            convert: EnvironmentGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve all compute environments for your organization. Environments provide isolated execution contexts for running code and workflows.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EnvironmentListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'compute/v1/environments',
            options: $requestOptions,
            convert: EnvironmentListResponse::class,
        );
    }

    /**
     * @api
     *
     * Permanently delete a compute environment and all its associated resources. This will stop all running deployments and clean up related configurations. The default environment cannot be deleted if other environments exist.
     *
     * @param string $name Name of the compute environment to delete
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EnvironmentDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $name,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['compute/v1/environments/%1$s', $name],
            options: $requestOptions,
            convert: EnvironmentDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Sets a compute environment as the default for the organization. Only one environment can be default at a time - setting a new default will automatically unset the previous one.
     *
     * @param string $name Name of the compute environment to set as default
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EnvironmentSetDefaultResponse>
     *
     * @throws APIException
     */
    public function setDefault(
        string $name,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['compute/v1/environments/%1$s/default', $name],
            options: $requestOptions,
            convert: EnvironmentSetDefaultResponse::class,
        );
    }
}
