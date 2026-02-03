<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\MemoryRawContract;

final class MemoryRawService implements MemoryRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
