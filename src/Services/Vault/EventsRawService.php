<?php

declare(strict_types=1);

namespace Casedev\Services\Vault;

use Casedev\Client;
use Casedev\ServiceContracts\Vault\EventsRawContract;

final class EventsRawService implements EventsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
