<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\ApplicationsRawContract;

final class ApplicationsRawService implements ApplicationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
