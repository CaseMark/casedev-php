<?php

declare(strict_types=1);

namespace CaseDev\Services\Webhooks\V1;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Webhooks\V1\EventTypesRawContract;

/**
 * Webhook endpoint management.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class EventTypesRawService implements EventTypesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns the catalog of event types that can be subscribed to via webhook endpoints. Each entry lists the required service scope the API key must carry to subscribe, plus the stability level.
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
            path: 'webhooks/v1/event_types',
            options: $requestOptions,
            convert: null,
        );
    }
}
