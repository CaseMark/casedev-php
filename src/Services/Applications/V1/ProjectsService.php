<?php

declare(strict_types=1);

namespace Casedev\Services\Applications\V1;

use Casedev\Applications\V1\Projects\ProjectCreateEnvParams\Type;
use Casedev\Applications\V1\Projects\ProjectCreateParams\EnvironmentVariable;
use Casedev\Applications\V1\Projects\ProjectListDeploymentsParams\Target;
use Casedev\Applications\V1\Projects\ProjectListResponse;
use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Applications\V1\ProjectsContract;

/**
 * @phpstan-import-type EnvironmentVariableShape from \Casedev\Applications\V1\Projects\ProjectCreateParams\EnvironmentVariable
 * @phpstan-import-type EnvironmentVariableShape from \Casedev\Applications\V1\Projects\ProjectCreateDeploymentParams\EnvironmentVariable as EnvironmentVariableShape1
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class ProjectsService implements ProjectsContract
{
    /**
     * @api
     */
    public ProjectsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ProjectsRawService($client);
    }

    /**
     * @api
     *
     * Create a new web application project
     *
     * @param string $gitRepo GitHub repository URL or "owner/repo"
     * @param string $name Project name
     * @param string $buildCommand Custom build command
     * @param list<EnvironmentVariable|EnvironmentVariableShape> $environmentVariables Environment variables to set on the project
     * @param string $framework Framework (e.g., "nextjs", "remix", "astro")
     * @param string $gitBranch Git branch to deploy
     * @param string $installCommand Custom install command
     * @param string $outputDirectory Build output directory
     * @param string $rootDirectory Root directory of the project
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'gitRepo' => $gitRepo,
                'name' => $name,
                'buildCommand' => $buildCommand,
                'environmentVariables' => $environmentVariables,
                'framework' => $framework,
                'gitBranch' => $gitBranch,
                'installCommand' => $installCommand,
                'outputDirectory' => $outputDirectory,
                'rootDirectory' => $rootDirectory,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get details of a specific web application project
     *
     * @param string $id Project ID
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
     * List all web application projects
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): ProjectListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a web application project
     *
     * @param string $id Project ID
     * @param bool $deleteFromHosting Also delete the project from hosting (default: true)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        bool $deleteFromHosting = true,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['deleteFromHosting' => $deleteFromHosting]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Trigger a new deployment for a project.
     *
     * @param string $id Project ID
     * @param list<\Casedev\Applications\V1\Projects\ProjectCreateDeploymentParams\EnvironmentVariable|EnvironmentVariableShape1> $environmentVariables Additional environment variables to set or update before deployment
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createDeployment(
        string $id,
        ?array $environmentVariables = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            ['environmentVariables' => $environmentVariables]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createDeployment($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Add a custom domain to a project
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
    ): mixed {
        $params = Util::removeNulls(
            ['domain' => $domain, 'gitBranch' => $gitBranch]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createDomain($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create a new environment variable for a project
     *
     * @param string $id Project ID
     * @param string $key Environment variable name
     * @param list<\Casedev\Applications\V1\Projects\ProjectCreateEnvParams\Target|value-of<\Casedev\Applications\V1\Projects\ProjectCreateEnvParams\Target>> $target Deployment targets for this variable
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'key' => $key,
                'target' => $target,
                'value' => $value,
                'gitBranch' => $gitBranch,
                'type' => $type,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createEnv($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Remove a domain from a project
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
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->deleteDomain($domain, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete an environment variable from a project
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
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->deleteEnv($envID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get runtime/function logs for a project
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
    ): mixed {
        $params = Util::removeNulls(['limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getRuntimeLogs($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List deployments for a specific project
     *
     * @param string $id Project ID
     * @param float $limit Maximum number of deployments to return
     * @param string $state Filter by deployment state
     * @param Target|value-of<Target> $target Filter by deployment target
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
    ): mixed {
        $params = Util::removeNulls(
            ['limit' => $limit, 'state' => $state, 'target' => $target]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listDeployments($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List all domains configured for a project
     *
     * @param string $id Project ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listDomains(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listDomains($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List all environment variables for a project (values are hidden unless decrypt=true)
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
    ): mixed {
        $params = Util::removeNulls(['decrypt' => $decrypt]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listEnv($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
