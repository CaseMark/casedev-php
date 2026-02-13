<?php

declare(strict_types=1);

namespace Casedev\Services\Vault\Events;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Vault\Events\SubscriptionsRawContract;
use Casedev\Vault\Events\Subscriptions\SubscriptionCreateParams;
use Casedev\Vault\Events\Subscriptions\SubscriptionDeleteParams;
use Casedev\Vault\Events\Subscriptions\SubscriptionTestParams;
use Casedev\Vault\Events\Subscriptions\SubscriptionUpdateParams;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
     * Creates a webhook subscription for vault lifecycle events. Optional object filters can limit notifications to specific vault objects.
     *
     * @param string $id Vault ID
     * @param array{
     *   callbackURL: string,
     *   eventTypes?: list<string>,
     *   objectIDs?: list<string>,
     *   signingSecret?: string,
     * }|SubscriptionCreateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = SubscriptionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['vault/%1$s/events/subscriptions', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Updates callback URL, filters, active state, or signing secret for a vault webhook subscription.
     *
     * @param string $subscriptionID Path param: Subscription ID
     * @param array{
     *   id: string,
     *   callbackURL?: string,
     *   clearSigningSecret?: bool,
     *   eventTypes?: list<string>,
     *   isActive?: bool,
     *   objectIDs?: list<string>,
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
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['vault/%1$s/events/subscriptions/%2$s', $id, $subscriptionID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Lists webhook subscriptions configured for a vault.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['vault/%1$s/events/subscriptions', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Deactivates a vault webhook subscription.
     *
     * @param string $subscriptionID Subscription ID
     * @param array{id: string}|SubscriptionDeleteParams $params
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
    ): BaseResponse {
        [$parsed, $options] = SubscriptionDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['vault/%1$s/events/subscriptions/%2$s', $id, $subscriptionID],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Delivers a test event to a single vault webhook subscription. Uses the same payload shape, signature, and retry behavior as production event delivery.
     *
     * @param string $subscriptionID Path param: Subscription ID
     * @param array{
     *   id: string,
     *   eventType?: string,
     *   objectID?: string,
     *   payload?: array<string,mixed>,
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
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['vault/%1$s/events/subscriptions/%2$s/test', $id, $subscriptionID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: null,
        );
    }
}
