<?php

declare(strict_types=1);

namespace CaseDev\Services\Usage\V1;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Usage\V1\SubscriptionsContract;

/**
 * Usage reporting and webhook subscriptions.
 *
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
     * Creates a webhook subscription for usage, balance, and billing events.
     *
     * @param list<string> $eventTypes
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $callbackURL,
        ?array $eventTypes = null,
        ?string $signingSecret = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'callbackURL' => $callbackURL,
                'eventTypes' => $eventTypes,
                'signingSecret' => $signingSecret,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Updates callback URL, event filters, active state, or signing secret.
     *
     * @param list<string> $eventTypes
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $subscriptionID,
        ?string $callbackURL = null,
        ?bool $clearSigningSecret = null,
        ?array $eventTypes = null,
        ?bool $isActive = null,
        ?string $signingSecret = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'callbackURL' => $callbackURL,
                'clearSigningSecret' => $clearSigningSecret,
                'eventTypes' => $eventTypes,
                'isActive' => $isActive,
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
     * Lists webhook subscriptions configured for usage and billing events.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Deactivates a usage webhook subscription.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $subscriptionID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($subscriptionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delivers a test event to a single usage webhook subscription using the same payload shape and signing behavior as production delivery.
     *
     * @param array<string,mixed> $payload
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function test(
        string $subscriptionID,
        ?string $eventType = null,
        ?array $payload = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            ['eventType' => $eventType, 'payload' => $payload]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->test($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
