<?php

declare(strict_types=1);

namespace Casedev\Services\Projects;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Projects\V1\V1CreateEnvVarsParams\EnvVar;
use Casedev\Projects\V1\V1CreateParams\SourceType;
use Casedev\Projects\V1\V1DeleteResponse;
use Casedev\Projects\V1\V1ListEnvVarsParams\Environment;
use Casedev\Projects\V1\V1ListResponse;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Projects\V1Contract;

/**
 * @phpstan-import-type EnvVarShape from \Casedev\Projects\V1\V1CreateEnvVarsParams\EnvVar
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
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
     * Create a new project for deployments
     *
     * @param string $name Project name
     * @param SourceType|value-of<SourceType> $sourceType
     * @param string $description Project description
     * @param string $githubRepo GitHub repo (owner/repo)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        SourceType|string $sourceType,
        ?string $buildCommand = null,
        string $defaultMemory = '0.5 GB',
        string $defaultVcpu = '0.25 vCPU',
        ?string $description = null,
        ?string $framework = null,
        string $githubBranch = 'main',
        ?string $githubRepo = null,
        ?string $installCommand = null,
        string $rootDirectory = './',
        ?string $s3SourceBucket = null,
        ?string $s3SourcePrefix = null,
        ?string $startCommand = null,
        ?string $thurgoodSessionID = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'sourceType' => $sourceType,
                'buildCommand' => $buildCommand,
                'defaultMemory' => $defaultMemory,
                'defaultVcpu' => $defaultVcpu,
                'description' => $description,
                'framework' => $framework,
                'githubBranch' => $githubBranch,
                'githubRepo' => $githubRepo,
                'installCommand' => $installCommand,
                'rootDirectory' => $rootDirectory,
                's3SourceBucket' => $s3SourceBucket,
                's3SourcePrefix' => $s3SourcePrefix,
                'startCommand' => $startCommand,
                'thurgoodSessionID' => $thurgoodSessionID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a project by ID with its deployments and settings
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List all projects for the organization
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): V1ListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a project and all its associated deployments, environment variables, and domains.
     *
     * @param string $id Project ID
     * @param bool $deleteDeployments Whether to also delete all deployments (default: true)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        bool $deleteDeployments = true,
        RequestOptions|array|null $requestOptions = null,
    ): V1DeleteResponse {
        $params = Util::removeNulls(['deleteDeployments' => $deleteDeployments]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create or update environment variables for a project
     *
     * @param list<EnvVar|EnvVarShape> $envVars
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createEnvVars(
        string $id,
        ?array $envVars = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['envVars' => $envVars]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createEnvVars($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List all environment variables for a project, grouped by environment
     *
     * @param Environment|value-of<Environment> $environment
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listEnvVars(
        string $id,
        Environment|string|null $environment = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['environment' => $environment]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listEnvVars($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
