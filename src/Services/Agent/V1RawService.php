<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent;

use CaseDev\Client;
use CaseDev\ServiceContracts\Agent\V1RawContract;

final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
