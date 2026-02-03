<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Database\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\Database\V1\Projects\ProjectCreateParams\Region;
use Casedev\Database\V1\Projects\ProjectDeleteResponse;
use Casedev\Database\V1\Projects\ProjectGetConnectionResponse;
use Casedev\Database\V1\Projects\ProjectGetResponse;
use Casedev\Database\V1\Projects\ProjectListBranchesResponse;
use Casedev\Database\V1\Projects\ProjectListResponse;
use Casedev\Database\V1\Projects\ProjectNewBranchResponse;
use Casedev\Database\V1\Projects\ProjectNewResponse;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
