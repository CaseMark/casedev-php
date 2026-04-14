<?php

declare(strict_types=1);

namespace CaseDev\Services\Applications\V1;

use CaseDev\Applications\V1\Projects\ProjectCreateDeploymentParams;
use CaseDev\Applications\V1\Projects\ProjectCreateDomainParams;
use CaseDev\Applications\V1\Projects\ProjectCreateEnvParams;
use CaseDev\Applications\V1\Projects\ProjectCreateEnvParams\Type;
use CaseDev\Applications\V1\Projects\ProjectCreateParams;
use CaseDev\Applications\V1\Projects\ProjectCreateParams\EnvironmentVariable;
use CaseDev\Applications\V1\Projects\ProjectDeleteDomainParams;
use CaseDev\Applications\V1\Projects\ProjectDeleteEnvParams;
use CaseDev\Applications\V1\Projects\ProjectDeleteParams;
use CaseDev\Applications\V1\Projects\ProjectGetRuntimeLogsParams;
use CaseDev\Applications\V1\Projects\ProjectListDeploymentsParams;
use CaseDev\Applications\V1\Projects\ProjectListDeploymentsParams\Target;
use CaseDev\Applications\V1\Projects\ProjectListEnvParams;
use CaseDev\Applications\V1\Projects\ProjectListParams;
use CaseDev\Applications\V1\Projects\ProjectListResponse;
use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Applications\V1\ProjectsRawContract;

/**
 * @phpstan-import-type EnvironmentVariableShape from \CaseDev\Applications\V1\Projects\ProjectCreateParams\EnvironmentVariable
 * @phpstan-import-type EnvironmentVariableShape from \CaseDev\Applications\V1\Projects\ProjectCreateDeploymentParams\EnvironmentVariable as EnvironmentVariableShape1
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class ProjectsRawService implements ProjectsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a new application project, validates GitHub access, provisions a default case.dev domain, and starts the deployment workflow. The initial response returns as soon as the workflow is queued so clients can poll for progress.
     *
     * @param array{
     *   gitRepo: string,
     *   name: string,
     *   buildCommand?: string,
     *   environmentVariables?: list<EnvironmentVariable|EnvironmentVariableShape>,
     *   framework?: string,
     *   gitBranch?: string,
     *   installCommand?: string,
     *   outputDirectory?: string,
     *   rootDirectory?: string,
     * }|ProjectCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|ProjectCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'applications/v1/projects',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Returns project details, domains, and recent deployment information for one application project. Use this endpoint when you need a single record with hosting metadata for a details view.
     *
     * @param string $id Project ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['applications/v1/projects/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Lists application projects for the authenticated organization. Use enrich=true to include additional hosting metadata for projects linked to Vercel.
     *
     * @param array{enrich?: bool, limit?: float}|ProjectListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|ProjectListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'applications/v1/projects',
            query: $parsed,
            options: $options,
            convert: ProjectListResponse::class,
        );
    }

    /**
     * @api
     *
     * Soft-deletes an application project from Case.dev. By default it also removes the linked hosting project; set deleteFromHosting=false to keep the external hosting resources intact.
     *
     * @param string $id Project ID
     * @param array{deleteFromHosting?: bool}|ProjectDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        array|ProjectDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['applications/v1/projects/%1$s', $id],
            query: $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Starts a new deployment for an existing project using its saved repository and hosting configuration. Any environment variables passed in the request are merged into the deployment workflow before the build starts.
     *
     * @param string $id Project ID
     * @param array{
     *   environmentVariables?: list<ProjectCreateDeploymentParams\EnvironmentVariable|EnvironmentVariableShape1>,
     * }|ProjectCreateDeploymentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function createDeployment(
        string $id,
        array|ProjectCreateDeploymentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectCreateDeploymentParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['applications/v1/projects/%1$s/deployments', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Add a custom domain to a project
     *
     * @param string $id Project ID
     * @param array{
     *   domain: string, gitBranch?: string
     * }|ProjectCreateDomainParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function createDomain(
        string $id,
        array|ProjectCreateDomainParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectCreateDomainParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['applications/v1/projects/%1$s/domains', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Create a new environment variable for a project
     *
     * @param string $id Project ID
     * @param array{
     *   key: string,
     *   target: list<ProjectCreateEnvParams\Target|value-of<ProjectCreateEnvParams\Target>>,
     *   value: string,
     *   gitBranch?: string,
     *   type?: Type|value-of<Type>,
     * }|ProjectCreateEnvParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function createEnv(
        string $id,
        array|ProjectCreateEnvParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectCreateEnvParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['applications/v1/projects/%1$s/env', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Remove a domain from a project
     *
     * @param string $domain Domain name to remove
     * @param array{id: string}|ProjectDeleteDomainParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function deleteDomain(
        string $domain,
        array|ProjectDeleteDomainParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectDeleteDomainParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['applications/v1/projects/%1$s/domains/%2$s', $id, $domain],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Delete an environment variable from a project
     *
     * @param string $envID Environment variable ID
     * @param array{id: string}|ProjectDeleteEnvParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function deleteEnv(
        string $envID,
        array|ProjectDeleteEnvParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectDeleteEnvParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['applications/v1/projects/%1$s/env/%2$s', $id, $envID],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get runtime/function logs for a project
     *
     * @param string $id Project ID
     * @param array{limit?: float}|ProjectGetRuntimeLogsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getRuntimeLogs(
        string $id,
        array|ProjectGetRuntimeLogsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectGetRuntimeLogsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['applications/v1/projects/%1$s/runtime-logs', $id],
            query: $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Lists deployments for one project in the authenticated organization. If the hosting project has not been created yet, this endpoint returns an empty list with a progress message instead of failing.
     *
     * @param string $id Project ID
     * @param array{
     *   limit?: float, state?: string, target?: Target|value-of<Target>
     * }|ProjectListDeploymentsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listDeployments(
        string $id,
        array|ProjectListDeploymentsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectListDeploymentsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['applications/v1/projects/%1$s/deployments', $id],
            query: $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List all domains configured for a project
     *
     * @param string $id Project ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listDomains(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['applications/v1/projects/%1$s/domains', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List all environment variables for a project (values are hidden unless decrypt=true)
     *
     * @param string $id Project ID
     * @param array{decrypt?: bool}|ProjectListEnvParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listEnv(
        string $id,
        array|ProjectListEnvParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectListEnvParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['applications/v1/projects/%1$s/env', $id],
            query: $parsed,
            options: $options,
            convert: null,
        );
    }
}
