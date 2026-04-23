<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Webhooks\V1;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Webhooks\V1\Deliveries\DeliveryListParams;
use CaseDev\Webhooks\V1\Deliveries\DeliveryReplayParams;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface DeliveriesRawContract
{
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
     * @param array<string,mixed>|DeliveryListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|DeliveryListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DeliveryReplayParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function replay(
        string $id,
        array|DeliveryReplayParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
