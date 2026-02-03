<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Projects;

use Casedev\Core\Exceptions\APIException;
use Casedev\Projects\V1\V1CreateEnvVarsParams\EnvVar;
use Casedev\Projects\V1\V1CreateParams\SourceType;
use Casedev\Projects\V1\V1DeleteResponse;
use Casedev\Projects\V1\V1ListEnvVarsParams\Environment;
use Casedev\Projects\V1\V1ListResponse;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type EnvVarShape from \Casedev\Projects\V1\V1CreateEnvVarsParams\EnvVar
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): V1ListResponse;

    /**
     * @api
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
    ): V1DeleteResponse;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;
}
