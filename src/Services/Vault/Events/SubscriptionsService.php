<?php

declare(strict_types=1);

namespace CaseDev\Services\Vault\Events;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Vault\Events\SubscriptionsContract;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class SubscriptionsService implements SubscriptionsContract
{
    /**
     * @api
     */
    public SubscriptionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SubscriptionsRawService($client);
    }

    /**
     * @api
     *
     * Creates a webhook subscription for vault lifecycle events. Optional object filters can limit notifications to specific vault objects.
     *
     * @param string $id Vault ID
     * @param list<string> $eventTypes
     * @param list<string> $objectIDs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $id,
        string $callbackURL,
        ?array $eventTypes = null,
        ?array $objectIDs = null,
        ?string $signingSecret = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'callbackURL' => $callbackURL,
                'eventTypes' => $eventTypes,
                'objectIDs' => $objectIDs,
                'signingSecret' => $signingSecret,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Updates callback URL, filters, active state, or signing secret for a vault webhook subscription.
     *
     * @param string $subscriptionID Path param: Subscription ID
     * @param string $id Path param: Vault ID
     * @param string $callbackURL Body param
     * @param bool $clearSigningSecret Body param
     * @param list<string> $eventTypes Body param
     * @param bool $isActive Body param
     * @param list<string> $objectIDs Body param
     * @param string $signingSecret Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $subscriptionID,
        string $id,
        ?string $callbackURL = null,
        ?bool $clearSigningSecret = null,
        ?array $eventTypes = null,
        ?bool $isActive = null,
        ?array $objectIDs = null,
        ?string $signingSecret = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'callbackURL' => $callbackURL,
                'clearSigningSecret' => $clearSigningSecret,
                'eventTypes' => $eventTypes,
                'isActive' => $isActive,
                'objectIDs' => $objectIDs,
                'signingSecret' => $signingSecret,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lists webhook subscriptions configured for a vault.
     *
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Deactivates a vault webhook subscription.
     *
     * @param string $subscriptionID Subscription ID
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $subscriptionID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delivers a test event to a single vault webhook subscription. Uses the same payload shape, signature, and retry behavior as production event delivery.
     *
     * @param string $subscriptionID Path param: Subscription ID
     * @param string $id Path param: Vault ID
     * @param string $eventType Body param: Optional event type override for this test
     * @param string $objectID Body param: Optional object ID for object-scoped payload testing
     * @param array<string,mixed> $payload Body param: Optional additional fields merged into payload.data
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function test(
        string $subscriptionID,
        string $id,
        ?string $eventType = null,
        ?string $objectID = null,
        ?array $payload = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'eventType' => $eventType,
                'objectID' => $objectID,
                'payload' => $payload,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->test($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
