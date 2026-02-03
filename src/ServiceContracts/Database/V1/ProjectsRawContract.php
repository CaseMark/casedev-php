<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Database\V1;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Database\V1\Projects\ProjectCreateBranchParams;
use Casedev\Database\V1\Projects\ProjectCreateParams;
use Casedev\Database\V1\Projects\ProjectDeleteResponse;
use Casedev\Database\V1\Projects\ProjectGetConnectionParams;
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
