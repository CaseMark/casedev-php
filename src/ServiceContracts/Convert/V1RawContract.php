<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Convert;

use Casedev\Convert\V1\V1ProcessParams;
use Casedev\Convert\V1\V1ProcessResponse;
use Casedev\Convert\V1\V1WebhookParams;
use Casedev\Convert\V1\V1WebhookResponse;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface V1RawContract
{
    /**
     * @api
     *
     * @param string $id The unique job ID of the completed conversion
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function download(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1ProcessParams $params
     *
     * @return BaseResponse<V1ProcessResponse>
     *
     * @throws APIException
     */
    public function process(
        array|V1ProcessParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1WebhookParams $params
     *
     * @return BaseResponse<V1WebhookResponse>
     *
     * @throws APIException
     */
    public function webhook(
        array|V1WebhookParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
