<?php

declare(strict_types=1);

namespace CaseDev\Services\Applications;

use CaseDev\Client;
use CaseDev\ServiceContracts\Applications\V1RawContract;

final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
