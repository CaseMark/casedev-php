<?php

declare(strict_types=1);

namespace CaseDev\Services\Applications\V1;

use CaseDev\Applications\V1\Projects\ProjectCreateEnvParams\Type;
use CaseDev\Applications\V1\Projects\ProjectCreateParams\EnvironmentVariable;
use CaseDev\Applications\V1\Projects\ProjectListDeploymentsParams\Target;
use CaseDev\Applications\V1\Projects\ProjectListResponse;
use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Applications\V1\ProjectsContract;

/**
 * @phpstan-import-type EnvironmentVariableShape from \CaseDev\Applications\V1\Projects\ProjectCreateParams\EnvironmentVariable
 * @phpstan-import-type EnvironmentVariableShape from \CaseDev\Applications\V1\Projects\ProjectCreateDeploymentParams\EnvironmentVariable as EnvironmentVariableShape1
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
     * Creates a new application project, validates GitHub access, provisions a default case.dev domain, and starts the deployment workflow. The initial response returns as soon as the workflow is queued so clients can poll for progress.
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
     * Returns project details, domains, and recent deployment information for one application project or deployed Thurgood app. Use this endpoint when you need a single record with hosting metadata for a details view.
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
     * Lists application projects and deployed Thurgood apps for the authenticated organization. Use enrich=true to include additional hosting metadata for projects linked to Vercel.
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
    ): ProjectListResponse {
        $params = Util::removeNulls(['enrich' => $enrich, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Soft-deletes an application project or deployed Thurgood app from Case.dev. By default it also removes the linked hosting project; set deleteFromHosting=false to keep the external hosting resources intact.
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
    ): mixed {
        $params = Util::removeNulls(['deleteFromHosting' => $deleteFromHosting]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Starts a new deployment for an existing project using its saved repository and hosting configuration. Any environment variables passed in the request are merged into the deployment workflow before the build starts.
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
     * Lists deployments for one project in the authenticated organization. If the hosting project has not been created yet, this endpoint returns an empty list with a progress message instead of failing.
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
