<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\Compute\V1\Environments\EnvironmentDeleteResponse;
use Casedev\Compute\V1\Environments\EnvironmentNewResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1\EnvironmentsContract;

final class EnvironmentsService implements EnvironmentsContract
{
    /**
     * @api
     */
    public EnvironmentsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new EnvironmentsRawService($client);
    }

    /**
     * @api
     *
     * Creates a new compute environment for running serverless workloads. Each environment gets its own isolated namespace with a unique domain for hosting applications and APIs. The first environment created becomes the default environment for the organization.
     *
     * @param string $name Environment name (alphanumeric, hyphens, and underscores only)
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?RequestOptions $requestOptions = null
    ): EnvironmentNewResponse {
        $params = ['name' => $name];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a specific compute environment by name. Returns environment configuration including status, domain, and metadata for your serverless compute infrastructure.
     *
     * @param string $name The name of the compute environment to retrieve
     *
     * @throws APIException
     */
    public function retrieve(
        string $name,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($name, requestOptions: $requestOptions);

        return $response->parse();
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
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Permanently delete a compute environment and all its associated resources. This will stop all running deployments and clean up related configurations. The default environment cannot be deleted if other environments exist.
     *
     * @param string $name Name of the compute environment to delete
     *
     * @throws APIException
     */
    public function delete(
        string $name,
        ?RequestOptions $requestOptions = null
    ): EnvironmentDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($name, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Sets a compute environment as the default for the organization. Only one environment can be default at a time - setting a new default will automatically unset the previous one.
     *
     * @param string $name Name of the compute environment to set as default
     *
     * @throws APIException
     */
    public function setDefault(
        string $name,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->setDefault($name, requestOptions: $requestOptions);

        return $response->parse();
    }
}
