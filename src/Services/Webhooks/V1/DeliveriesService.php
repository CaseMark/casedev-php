<?php

declare(strict_types=1);

namespace CaseDev\Services\Webhooks\V1;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Webhooks\V1\DeliveriesContract;
use CaseDev\Webhooks\V1\Deliveries\DeliveryListParams\Status;

/**
 * Webhook endpoint management.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class DeliveriesService implements DeliveriesContract
{
    /**
     * @api
     */
    public DeliveriesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DeliveriesRawService($client);
    }

    /**
     * @api
     *
     * Get webhook delivery
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns delivery attempts for the organization, newest first. Filter by endpoint_id or status to narrow results.
     *
     * @param Status|value-of<Status> $status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $endpointID = null,
        int $limit = 50,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            ['endpointID' => $endpointID, 'limit' => $limit, 'status' => $status]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Re-sends the original event to its endpoint. The payload is reconstructed from the delivery record (same eventId, eventType, and occurred_at). The signature header includes `svix-delivery-attempt: replay` so receivers can distinguish replays from first-time deliveries. Uses the endpoint's current signing secret — not the one in force at the original delivery time.
     *
     * @param mixed $payload Override payload to deliver. Must only be supplied when the delivery record lacks enough context to reconstruct the original event (rare). Defaults to an empty data envelope.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function replay(
        string $id,
        mixed $payload = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['payload' => $payload]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->replay($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
