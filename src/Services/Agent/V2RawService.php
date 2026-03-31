<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent;

use CaseDev\Client;
use CaseDev\ServiceContracts\Agent\V2RawContract;

final class V2RawService implements V2RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
