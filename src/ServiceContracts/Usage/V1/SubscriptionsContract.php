<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Usage\V1;

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
    ): mixed;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $subscriptionID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): mixed;
}
