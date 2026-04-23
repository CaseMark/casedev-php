<?php

declare(strict_types=1);

namespace CaseDev\Services\Webhooks\V1;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Webhooks\V1\DeliveriesRawContract;
use CaseDev\Webhooks\V1\Deliveries\DeliveryListParams;
use CaseDev\Webhooks\V1\Deliveries\DeliveryListParams\Status;
use CaseDev\Webhooks\V1\Deliveries\DeliveryReplayParams;

/**
 * Webhook endpoint management.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class DeliveriesRawService implements DeliveriesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get webhook delivery
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['webhooks/v1/deliveries/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Returns delivery attempts for the organization, newest first. Filter by endpoint_id or status to narrow results.
     *
     * @param array{
     *   endpointID?: string, limit?: int, status?: Status|value-of<Status>
     * }|DeliveryListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|DeliveryListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeliveryListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'webhooks/v1/deliveries',
            query: Util::array_transform_keys(
                $parsed,
                ['endpointID' => 'endpoint_id']
            ),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Re-sends the original event to its endpoint. The payload is reconstructed from the delivery record (same eventId, eventType, and occurred_at). The signature header includes `svix-delivery-attempt: replay` so receivers can distinguish replays from first-time deliveries. Uses the endpoint's current signing secret — not the one in force at the original delivery time.
     *
     * @param array{payload?: mixed}|DeliveryReplayParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function replay(
        string $id,
        array|DeliveryReplayParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeliveryReplayParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['webhooks/v1/deliveries/%1$s/replay', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }
}
