<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\ServiceContracts\UsageRawContract;

final class UsageRawService implements UsageRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
