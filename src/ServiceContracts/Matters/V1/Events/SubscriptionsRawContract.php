<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Matters\V1\Events;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\Events\Subscriptions\SubscriptionCreateParams;
use CaseDev\Matters\V1\Events\Subscriptions\SubscriptionDeleteParams;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface SubscriptionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SubscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|SubscriptionCreateParams $params,
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
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SubscriptionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $subscriptionID,
        array|SubscriptionDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
