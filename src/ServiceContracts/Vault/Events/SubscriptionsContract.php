<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Vault\Events;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface SubscriptionsContract
{
    /**
     * @api
     *
     * @param string $id Vault ID
     * @param string $callbackURL Webhook endpoint URL that will receive vault event deliveries
     * @param list<string> $eventTypes Vault event types to deliver. Omit to receive the default supported set.
     * @param list<string> $objectIDs Vault object IDs to limit notifications to. Omit to receive events for all objects in the vault.
     * @param string $signingSecret Optional secret used to sign outbound webhook deliveries
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
    ): mixed;

    /**
     * @api
     *
     * @param string $subscriptionID Path param: Subscription ID
     * @param string $id Path param: Vault ID
     * @param string $callbackURL Body param: Updated webhook endpoint URL for deliveries
     * @param bool $clearSigningSecret Body param: Whether to remove the existing signing secret
     * @param list<string> $eventTypes Body param: Updated event types to deliver for this subscription
     * @param bool $isActive Body param: Whether the subscription should continue delivering events
     * @param list<string> $objectIDs Body param: Updated vault object IDs to limit notifications to. Pass an empty array to remove the filter.
     * @param string $signingSecret Body param: Replacement secret used to sign webhook deliveries
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
    ): mixed;

    /**
     * @api
     *
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;
}
