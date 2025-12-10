<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Actions;

use Casedev\Actions\V1\V1CreateParams;
use Casedev\Actions\V1\V1ExecuteParams;
use Casedev\Actions\V1\V1ExecuteResponse;
use Casedev\Actions\V1\V1NewResponse;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface V1RawContract
{
    /**
     * @api
     *
     * @param array<mixed>|V1CreateParams $params
     *
     * @return BaseResponse<V1NewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|V1CreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier of the action definition
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
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): BaseResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier of the action to delete
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id The unique identifier of the action to execute
     * @param array<mixed>|V1ExecuteParams $params
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
     * @param string $id The unique identifier of the action execution
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
