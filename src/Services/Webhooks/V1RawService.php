<?php

declare(strict_types=1);

namespace CaseDev\Services\Webhooks;

use CaseDev\Client;
use CaseDev\ServiceContracts\Webhooks\V1RawContract;

final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
