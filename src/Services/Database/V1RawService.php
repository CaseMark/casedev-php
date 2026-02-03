<?php

declare(strict_types=1);

namespace Casedev\Services\Database;

use Casedev\Client;
use Casedev\ServiceContracts\Database\V1RawContract;

final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
