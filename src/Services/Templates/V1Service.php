<?php

declare(strict_types=1);

namespace Casedev\Services\Templates;

use Casedev\Client;
use Casedev\ServiceContracts\Templates\V1Contract;

final class V1Service implements V1Contract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
