<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Database\V1;

use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\Database\V1\Projects\ProjectCreateBranchParams;
use Router\Database\V1\Projects\ProjectCreateParams;
use Router\Database\V1\Projects\ProjectDeleteResponse;
use Router\Database\V1\Projects\ProjectGetConnectionParams;
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
interface ProjectsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ProjectCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|ProjectCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Database project ID
     * @param array<string,mixed>|ProjectCreateBranchParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Database project ID
     * @param array<string,mixed>|ProjectGetConnectionParams $params
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
