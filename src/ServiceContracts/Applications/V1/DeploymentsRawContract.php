<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Applications\V1;

use CaseDev\Applications\V1\Deployments\DeploymentCancelParams;
use CaseDev\Applications\V1\Deployments\DeploymentCreateParams;
use CaseDev\Applications\V1\Deployments\DeploymentGetLogsParams;
use CaseDev\Applications\V1\Deployments\DeploymentListParams;
use CaseDev\Applications\V1\Deployments\DeploymentRetrieveParams;
use CaseDev\Applications\V1\Deployments\DeploymentStreamParams;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface DeploymentsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|DeploymentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|DeploymentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Deployment ID
     * @param array<string,mixed>|DeploymentRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        array|DeploymentRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DeploymentListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|DeploymentListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Deployment ID
     * @param array<string,mixed>|DeploymentCancelParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        array|DeploymentCancelParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function createFromFiles(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Deployment ID
     * @param array<string,mixed>|DeploymentGetLogsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getLogs(
        string $id,
        array|DeploymentGetLogsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Deployment ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getStatus(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Workflow run ID
     * @param array<string,mixed>|DeploymentStreamParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function stream(
        string $id,
        array|DeploymentStreamParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
