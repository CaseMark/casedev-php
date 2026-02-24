<?php

declare(strict_types=1);

namespace CaseDev\Services\Vault;

use CaseDev\Client;
use CaseDev\ServiceContracts\Vault\EventsRawContract;

final class EventsRawService implements EventsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
