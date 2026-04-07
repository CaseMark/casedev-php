<?php

declare(strict_types=1);

namespace CaseDev\Services\Usage\V1;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Usage\V1\SubscriptionsRawContract;
use CaseDev\Usage\V1\Subscriptions\SubscriptionCreateParams;
use CaseDev\Usage\V1\Subscriptions\SubscriptionTestParams;
use CaseDev\Usage\V1\Subscriptions\SubscriptionUpdateParams;

/**
 * Usage reporting and webhook subscriptions.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class SubscriptionsRawService implements SubscriptionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a webhook subscription for usage, balance, and billing events.
     *
     * @param array{
     *   callbackURL: string, eventTypes?: list<string>, signingSecret?: string
     * }|SubscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|SubscriptionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SubscriptionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'usage/v1/subscriptions',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Updates callback URL, event filters, active state, or signing secret.
     *
     * @param array{
     *   callbackURL?: string,
     *   clearSigningSecret?: bool,
     *   eventTypes?: list<string>,
     *   isActive?: bool,
     *   signingSecret?: string,
     * }|SubscriptionUpdateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = SubscriptionUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['usage/v1/subscriptions/%1$s', $subscriptionID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Lists webhook subscriptions configured for usage and billing events.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'usage/v1/subscriptions',
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Deactivates a usage webhook subscription.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['usage/v1/subscriptions/%1$s', $subscriptionID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Delivers a test event to a single usage webhook subscription using the same payload shape and signing behavior as production delivery.
     *
     * @param array{
     *   eventType?: string, payload?: array<string,mixed>
     * }|SubscriptionTestParams $params
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
    ): BaseResponse {
        [$parsed, $options] = SubscriptionTestParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['usage/v1/subscriptions/%1$s/test', $subscriptionID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }
}
