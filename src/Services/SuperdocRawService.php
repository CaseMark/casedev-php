<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\SuperdocRawContract;

final class SuperdocRawService implements SuperdocRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
