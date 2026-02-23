<?php

declare(strict_types=1);

namespace Router\Services\Vault;

use Router\Client;
use Router\ServiceContracts\Vault\EventsContract;
use Router\Services\Vault\Events\SubscriptionsService;

final class EventsService implements EventsContract
{
    /**
     * @api
     */
    public EventsRawService $raw;

    /**
     * @api
     */
    public SubscriptionsService $subscriptions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new EventsRawService($client);
        $this->subscriptions = new SubscriptionsService($client);
    }
}
