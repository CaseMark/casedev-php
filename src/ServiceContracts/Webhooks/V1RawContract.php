<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Webhooks;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Webhooks\V1\V1CreateParams;
use Casedev\Webhooks\V1\V1NewResponse;

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
     * @param string $id Unique identifier of the webhook endpoint
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
     * @param string $id Unique identifier of the webhook endpoint to delete
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
