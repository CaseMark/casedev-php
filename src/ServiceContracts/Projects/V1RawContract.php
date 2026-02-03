<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Projects;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Projects\V1\V1CreateEnvVarsParams;
use Casedev\Projects\V1\V1CreateParams;
use Casedev\Projects\V1\V1DeleteParams;
use Casedev\Projects\V1\V1DeleteResponse;
use Casedev\Projects\V1\V1ListEnvVarsParams;
use Casedev\Projects\V1\V1ListResponse;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1CreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|V1CreateParams $params,
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
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ListResponse>
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
     * @param array<string,mixed>|V1DeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1DeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        array|V1DeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1CreateEnvVarsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function createEnvVars(
        string $id,
        array|V1CreateEnvVarsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1ListEnvVarsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listEnvVars(
        string $id,
        array|V1ListEnvVarsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
