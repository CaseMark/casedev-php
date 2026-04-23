<?php

declare(strict_types=1);

namespace CaseDev\Services\Webhooks\V1;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Webhooks\V1\EventTypesContract;

/**
 * Webhook endpoint management.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class EventTypesService implements EventTypesContract
{
    /**
     * @api
     */
    public EventTypesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new EventTypesRawService($client);
    }

    /**
     * @api
     *
     * Returns the catalog of event types that can be subscribed to via webhook endpoints. Each entry lists the required service scope the API key must carry to subscribe, plus the stability level.
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
}
