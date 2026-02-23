<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Vault\Events;

use Router\Core\Exceptions\APIException;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface SubscriptionsContract
{
    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
