<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Compute\V1\Environments\EnvironmentCreateParams;
use Casedev\Compute\V1\Environments\EnvironmentDeleteResponse;
use Casedev\Compute\V1\Environments\EnvironmentNewResponse;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface EnvironmentsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|EnvironmentCreateParams $params
     *
     * @return BaseResponse<EnvironmentNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|EnvironmentCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $name The name of the compute environment to retrieve
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $name,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): BaseResponse;

    /**
     * @api
     *
     * @param string $name Name of the compute environment to delete
     *
     * @return BaseResponse<EnvironmentDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $name,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $name Name of the compute environment to set as default
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function setDefault(
        string $name,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
