<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Applications\V1;

use Casedev\Applications\V1\Projects\ProjectCreateDeploymentParams;
use Casedev\Applications\V1\Projects\ProjectCreateDomainParams;
use Casedev\Applications\V1\Projects\ProjectCreateEnvParams;
use Casedev\Applications\V1\Projects\ProjectCreateParams;
use Casedev\Applications\V1\Projects\ProjectDeleteDomainParams;
use Casedev\Applications\V1\Projects\ProjectDeleteEnvParams;
use Casedev\Applications\V1\Projects\ProjectDeleteParams;
use Casedev\Applications\V1\Projects\ProjectGetRuntimeLogsParams;
use Casedev\Applications\V1\Projects\ProjectListDeploymentsParams;
use Casedev\Applications\V1\Projects\ProjectListEnvParams;
use Casedev\Applications\V1\Projects\ProjectListResponse;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
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
     * @return BaseResponse<mixed>
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
     * @param string $id Project ID
     * @param array<string,mixed>|ProjectDeleteParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Project ID
     * @param array<string,mixed>|ProjectCreateDeploymentParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Project ID
     * @param array<string,mixed>|ProjectCreateDomainParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Project ID
     * @param array<string,mixed>|ProjectCreateEnvParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $domain Domain name to remove
     * @param array<string,mixed>|ProjectDeleteDomainParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $envID Environment variable ID
     * @param array<string,mixed>|ProjectDeleteEnvParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Project ID
     * @param array<string,mixed>|ProjectGetRuntimeLogsParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Project ID
     * @param array<string,mixed>|ProjectListDeploymentsParams $params
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Project ID
     * @param array<string,mixed>|ProjectListEnvParams $params
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
    ): BaseResponse;
}
