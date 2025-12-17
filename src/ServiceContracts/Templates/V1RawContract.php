<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Templates;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Templates\V1\V1ExecuteParams;
use Casedev\Templates\V1\V1ExecuteResponse;
use Casedev\Templates\V1\V1ListParams;
use Casedev\Templates\V1\V1SearchParams;

interface V1RawContract
{
    /**
     * @api
     *
     * @param string $id Workflow ID
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1ListParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|V1ListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier of the workflow to execute
     * @param array<string,mixed>|V1ExecuteParams $params
     *
     * @return BaseResponse<V1ExecuteResponse>
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        array|V1ExecuteParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier of the workflow execution
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1SearchParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function search(
        array|V1SearchParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
