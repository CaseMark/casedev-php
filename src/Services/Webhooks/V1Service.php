<?php

declare(strict_types=1);

namespace CaseDev\Services\Webhooks;

use CaseDev\Client;
use CaseDev\ServiceContracts\Webhooks\V1Contract;
use CaseDev\Services\Webhooks\V1\DeliveriesService;
use CaseDev\Services\Webhooks\V1\EndpointsService;
use CaseDev\Services\Webhooks\V1\EventTypesService;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @api
     */
    public EndpointsService $endpoints;

    /**
     * @api
     */
    public DeliveriesService $deliveries;

    /**
     * @api
     */
    public EventTypesService $eventTypes;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->endpoints = new EndpointsService($client);
        $this->deliveries = new DeliveriesService($client);
        $this->eventTypes = new EventTypesService($client);
    }
}
