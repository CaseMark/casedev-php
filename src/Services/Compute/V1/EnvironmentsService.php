<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\Compute\V1\Environments\EnvironmentCreateParams;
use Casedev\Compute\V1\Environments\EnvironmentDeleteResponse;
use Casedev\Compute\V1\Environments\EnvironmentNewResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1\EnvironmentsContract;

final class EnvironmentsService implements EnvironmentsContract
{
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
     *
     * @throws APIException
     */
    public function create(
        array|EnvironmentCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): EnvironmentNewResponse {
        [$parsed, $options] = EnvironmentCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function retrieve(
        string $name,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['compute/v1/environments/%1$s', $name],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Retrieve all compute environments for your organization. Environments provide isolated execution contexts for running code and workflows.
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): mixed
    {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'compute/v1/environments',
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Permanently delete a compute environment and all its associated resources. This will stop all running deployments and clean up related configurations. The default environment cannot be deleted if other environments exist.
     *
     * @throws APIException
     */
    public function delete(
        string $name,
        ?RequestOptions $requestOptions = null
    ): EnvironmentDeleteResponse {
        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function setDefault(
        string $name,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['compute/v1/environments/%1$s/default', $name],
            options: $requestOptions,
            convert: null,
        );
    }
}
