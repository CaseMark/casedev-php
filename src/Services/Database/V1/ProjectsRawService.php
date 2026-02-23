<?php

declare(strict_types=1);

namespace Router\Services\Database\V1;

use Router\Client;
use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\Database\V1\Projects\ProjectCreateBranchParams;
use Router\Database\V1\Projects\ProjectCreateParams;
use Router\Database\V1\Projects\ProjectCreateParams\Region;
use Router\Database\V1\Projects\ProjectDeleteResponse;
use Router\Database\V1\Projects\ProjectGetConnectionParams;
use Router\Database\V1\Projects\ProjectGetConnectionResponse;
use Router\Database\V1\Projects\ProjectGetResponse;
use Router\Database\V1\Projects\ProjectListBranchesResponse;
use Router\Database\V1\Projects\ProjectListResponse;
use Router\Database\V1\Projects\ProjectNewBranchResponse;
use Router\Database\V1\Projects\ProjectNewResponse;
use Router\RequestOptions;
use Router\ServiceContracts\Database\V1\ProjectsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
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
     * Creates a new serverless Postgres database project powered by Neon. Includes automatic scaling, connection pooling, and a default 'main' branch with 'neondb' database. Supports branching for isolated dev/staging environments. Perfect for case management applications, document workflows, and litigation support systems.
     *
     * @param array{
     *   name: string, description?: string, region?: value-of<Region>
     * }|ProjectCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectNewResponse>
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
            path: 'database/v1/projects',
            body: (object) $parsed,
            options: $options,
            convert: ProjectNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieves detailed information about a specific database project including branches, databases, storage/compute metrics, connection host, and linked deployments. Fetches live usage statistics from Neon API.
     *
     * @param string $id Database project ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectGetResponse>
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
            path: ['database/v1/projects/%1$s', $id],
            options: $requestOptions,
            convert: ProjectGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieves all serverless Postgres database projects for the authenticated organization. Includes storage and compute metrics, plus linked deployments from Thurgood apps and Compute instances.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'database/v1/projects',
            options: $requestOptions,
            convert: ProjectListResponse::class,
        );
    }

    /**
     * @api
     *
     * Permanently deletes a database project from Neon and marks it as deleted in Case.dev. This action cannot be undone and will destroy all data including branches and databases. Use with caution.
     *
     * @param string $id Database project ID to delete
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['database/v1/projects/%1$s', $id],
            options: $requestOptions,
            convert: ProjectDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Creates a new branch from the specified parent branch (or default 'main' branch). Branches provide instant point-in-time clones of your database for isolated development, staging, testing, or feature work. Perfect for testing schema changes, running migrations safely, or creating ephemeral preview environments.
     *
     * @param string $id Database project ID
     * @param array{
     *   name: string, parentBranchID?: string
     * }|ProjectCreateBranchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectNewBranchResponse>
     *
     * @throws APIException
     */
    public function createBranch(
        string $id,
        array|ProjectCreateBranchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectCreateBranchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['database/v1/projects/%1$s/branches', $id],
            body: (object) $parsed,
            options: $options,
            convert: ProjectNewBranchResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieves the PostgreSQL connection URI for a database project. Supports selecting specific branches and pooled vs direct connections. Connection strings include credentials and should be stored securely. Use for configuring applications and deployment environments.
     *
     * @param string $id Database project ID
     * @param array{branch?: string, pooled?: bool}|ProjectGetConnectionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectGetConnectionResponse>
     *
     * @throws APIException
     */
    public function getConnection(
        string $id,
        array|ProjectGetConnectionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectGetConnectionParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['database/v1/projects/%1$s/connection', $id],
            query: $parsed,
            options: $options,
            convert: ProjectGetConnectionResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieves all branches for a database project. Branches enable isolated development and testing environments with instant point-in-time cloning. Each branch includes the default branch and any custom branches created for staging, testing, or feature development.
     *
     * @param string $id Database project ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectListBranchesResponse>
     *
     * @throws APIException
     */
    public function listBranches(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['database/v1/projects/%1$s/branches', $id],
            options: $requestOptions,
            convert: ProjectListBranchesResponse::class,
        );
    }
}
