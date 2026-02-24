<?php

declare(strict_types=1);

namespace CaseDev\Services\Vault;

use CaseDev\Client;
use CaseDev\ServiceContracts\Vault\EventsContract;
use CaseDev\Services\Vault\Events\SubscriptionsService;

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
