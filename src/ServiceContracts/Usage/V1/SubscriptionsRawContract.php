<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Usage\V1;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Usage\V1\Subscriptions\SubscriptionCreateParams;
use CaseDev\Usage\V1\Subscriptions\SubscriptionTestParams;
use CaseDev\Usage\V1\Subscriptions\SubscriptionUpdateParams;

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
        array|SubscriptionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
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
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
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
    public function delete(
        string $subscriptionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
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
