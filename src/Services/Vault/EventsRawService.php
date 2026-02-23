<?php

declare(strict_types=1);

namespace Router\Services\Vault;

use Router\Client;
use Router\ServiceContracts\Vault\EventsRawContract;

final class EventsRawService implements EventsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
