<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Vault\Events;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Vault\Events\Subscriptions\SubscriptionCreateParams;
use CaseDev\Vault\Events\Subscriptions\SubscriptionDeleteParams;
use CaseDev\Vault\Events\Subscriptions\SubscriptionTestParams;
use CaseDev\Vault\Events\Subscriptions\SubscriptionUpdateParams;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface SubscriptionsRawContract
{
    /**
     * @api
     *
     * @param string $id Vault ID
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
     * @param string $subscriptionID Path param: Subscription ID
     * @param array<string,mixed>|SubscriptionUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $subscriptionID,
        array|SubscriptionUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Vault ID
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
     * @param string $subscriptionID Subscription ID
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

    /**
     * @api
     *
     * @param string $subscriptionID Path param: Subscription ID
     * @param array<string,mixed>|SubscriptionTestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function test(
        string $subscriptionID,
        array|SubscriptionTestParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
