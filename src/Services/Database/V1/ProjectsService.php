<?php

declare(strict_types=1);

namespace CaseDev\Services\Database\V1;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\Database\V1\Projects\ProjectCreateParams\Region;
use CaseDev\Database\V1\Projects\ProjectDeleteResponse;
use CaseDev\Database\V1\Projects\ProjectGetConnectionResponse;
use CaseDev\Database\V1\Projects\ProjectGetResponse;
use CaseDev\Database\V1\Projects\ProjectListBranchesResponse;
use CaseDev\Database\V1\Projects\ProjectListResponse;
use CaseDev\Database\V1\Projects\ProjectNewBranchResponse;
use CaseDev\Database\V1\Projects\ProjectNewResponse;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Database\V1\ProjectsContract;

/**
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
     * Creates a new serverless Postgres database project powered by Neon. Includes automatic scaling, connection pooling, and a default 'main' branch with 'neondb' database. Supports branching for isolated dev/staging environments. Perfect for case management applications, document workflows, and litigation support systems.
     *
     * @param string $name Project name (letters, numbers, hyphens, underscores only)
     * @param string $description Optional project description
     * @param Region|value-of<Region> $region AWS region for database deployment
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?string $description = null,
        Region|string $region = 'aws-us-east-1',
        RequestOptions|array|null $requestOptions = null,
    ): ProjectNewResponse {
        $params = Util::removeNulls(
            ['name' => $name, 'description' => $description, 'region' => $region]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves detailed information about a specific database project including branches, databases, storage/compute metrics, connection host, and linked deployments. Fetches live usage statistics from Neon API.
     *
     * @param string $id Database project ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ProjectGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves all serverless Postgres database projects for the authenticated organization. Includes storage and compute metrics, plus linked deployments from Thurgood apps and Compute instances.
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
     * Permanently deletes a database project from Neon and marks it as deleted in Case.dev. This action cannot be undone and will destroy all data including branches and databases. Use with caution.
     *
     * @param string $id Database project ID to delete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ProjectDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Creates a new branch from the specified parent branch (or default 'main' branch). Branches provide instant point-in-time clones of your database for isolated development, staging, testing, or feature work. Perfect for testing schema changes, running migrations safely, or creating ephemeral preview environments.
     *
     * @param string $id Database project ID
     * @param string $name Branch name (letters, numbers, hyphens, underscores only)
     * @param string $parentBranchID Parent branch ID to clone from (defaults to main branch)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createBranch(
        string $id,
        string $name,
        ?string $parentBranchID = null,
        RequestOptions|array|null $requestOptions = null,
    ): ProjectNewBranchResponse {
        $params = Util::removeNulls(
            ['name' => $name, 'parentBranchID' => $parentBranchID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createBranch($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves the PostgreSQL connection URI for a database project. Supports selecting specific branches and pooled vs direct connections. Connection strings include credentials and should be stored securely. Use for configuring applications and deployment environments.
     *
     * @param string $id Database project ID
     * @param string $branch Branch name (defaults to 'main')
     * @param bool $pooled Use pooled connection (PgBouncer)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getConnection(
        string $id,
        ?string $branch = null,
        ?bool $pooled = null,
        RequestOptions|array|null $requestOptions = null,
    ): ProjectGetConnectionResponse {
        $params = Util::removeNulls(['branch' => $branch, 'pooled' => $pooled]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getConnection($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves all branches for a database project. Branches enable isolated development and testing environments with instant point-in-time cloning. Each branch includes the default branch and any custom branches created for staging, testing, or feature development.
     *
     * @param string $id Database project ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listBranches(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ProjectListBranchesResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listBranches($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
