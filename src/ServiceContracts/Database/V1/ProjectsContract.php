<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Database\V1;

use Router\Core\Exceptions\APIException;
use Router\Database\V1\Projects\ProjectCreateParams\Region;
use Router\Database\V1\Projects\ProjectDeleteResponse;
use Router\Database\V1\Projects\ProjectGetConnectionResponse;
use Router\Database\V1\Projects\ProjectGetResponse;
use Router\Database\V1\Projects\ProjectListBranchesResponse;
use Router\Database\V1\Projects\ProjectListResponse;
use Router\Database\V1\Projects\ProjectNewBranchResponse;
use Router\Database\V1\Projects\ProjectNewResponse;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface ProjectsContract
{
    /**
     * @api
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
    ): ProjectNewResponse;

    /**
     * @api
     *
     * @param string $id Database project ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ProjectGetResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): ProjectListResponse;

    /**
     * @api
     *
     * @param string $id Database project ID to delete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ProjectDeleteResponse;

    /**
     * @api
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
    ): ProjectNewBranchResponse;

    /**
     * @api
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
    ): ProjectGetConnectionResponse;

    /**
     * @api
     *
     * @param string $id Database project ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listBranches(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ProjectListBranchesResponse;
}
