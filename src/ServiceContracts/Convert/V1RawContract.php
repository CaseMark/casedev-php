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

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param string $id The unique job ID of the completed conversion
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function download(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1ProcessParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ProcessResponse>
     *
     * @throws APIException
     */
    public function process(
        array|V1ProcessParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1WebhookParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1WebhookResponse>
     *
     * @throws APIException
     */
    public function webhook(
        array|V1WebhookParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
