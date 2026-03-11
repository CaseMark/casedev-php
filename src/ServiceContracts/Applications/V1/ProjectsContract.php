<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Applications\V1;

use CaseDev\Applications\V1\Projects\ProjectCreateEnvParams\Type;
use CaseDev\Applications\V1\Projects\ProjectCreateParams\EnvironmentVariable;
use CaseDev\Applications\V1\Projects\ProjectListDeploymentsParams\Target;
use CaseDev\Applications\V1\Projects\ProjectListResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type EnvironmentVariableShape from \CaseDev\Applications\V1\Projects\ProjectCreateParams\EnvironmentVariable
 * @phpstan-import-type EnvironmentVariableShape from \CaseDev\Applications\V1\Projects\ProjectCreateDeploymentParams\EnvironmentVariable as EnvironmentVariableShape1
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface ProjectsContract
{
    /**
     * @api
     *
     * @param string $gitRepo GitHub repository URL or owner/repo identifier
     * @param string $name Human-readable project name
     * @param string $buildCommand Custom build command to override the framework default
     * @param list<EnvironmentVariable|EnvironmentVariableShape> $environmentVariables Environment variables to create before the first deployment
     * @param string $framework Framework preset for the hosting project, such as nextjs or remix
     * @param string $gitBranch Git branch to deploy. Defaults to main.
     * @param string $installCommand Custom install command to override the framework default
     * @param string $outputDirectory Build output directory relative to the project root
     * @param string $rootDirectory Repository subdirectory that contains the app to deploy
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $gitRepo,
        string $name,
        ?string $buildCommand = null,
        ?array $environmentVariables = null,
        ?string $framework = null,
        string $gitBranch = 'main',
        ?string $installCommand = null,
        ?string $outputDirectory = null,
        ?string $rootDirectory = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Project ID
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
     * @param bool $enrich Whether to include additional hosting metadata from Vercel
     * @param float $limit Maximum number of projects to return from each backing source
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        bool $enrich = false,
        float $limit = 20,
        RequestOptions|array|null $requestOptions = null,
    ): ProjectListResponse;

    /**
     * @api
     *
     * @param string $id Project ID
     * @param bool $deleteFromHosting Whether to also delete the linked hosting project. Defaults to true.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        bool $deleteFromHosting = true,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Project ID
     * @param list<\CaseDev\Applications\V1\Projects\ProjectCreateDeploymentParams\EnvironmentVariable|EnvironmentVariableShape1> $environmentVariables Additional environment variables to set or update before deployment
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createDeployment(
        string $id,
        ?array $environmentVariables = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Project ID
     * @param string $domain Domain name to add
     * @param string $gitBranch Git branch to associate with this domain
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createDomain(
        string $id,
        string $domain,
        ?string $gitBranch = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Project ID
     * @param string $key Environment variable name
     * @param list<\CaseDev\Applications\V1\Projects\ProjectCreateEnvParams\Target|value-of<\CaseDev\Applications\V1\Projects\ProjectCreateEnvParams\Target>> $target Deployment targets for this variable
     * @param string $value Environment variable value
     * @param string $gitBranch Specific git branch (for preview deployments)
     * @param Type|value-of<Type> $type Variable type
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createEnv(
        string $id,
        string $key,
        array $target,
        string $value,
        ?string $gitBranch = null,
        Type|string $type = 'encrypted',
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $domain Domain name to remove
     * @param string $id Project ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function deleteDomain(
        string $domain,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $envID Environment variable ID
     * @param string $id Project ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function deleteEnv(
        string $envID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Project ID
     * @param float $limit Maximum number of logs to return
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getRuntimeLogs(
        string $id,
        float $limit = 100,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Project ID
     * @param float $limit Maximum number of deployments to return
     * @param string $state Deployment state to filter by
     * @param Target|value-of<Target> $target Deployment target to filter by
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listDeployments(
        string $id,
        float $limit = 20,
        ?string $state = null,
        Target|string|null $target = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Project ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listDomains(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $id Project ID
     * @param bool $decrypt Whether to decrypt and return values (requires appropriate permissions)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listEnv(
        string $id,
        bool $decrypt = false,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
