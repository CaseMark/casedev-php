<?php

declare(strict_types=1);

namespace Casedev\Services\Payments;

use Casedev\Client;
use Casedev\ServiceContracts\Payments\V1RawContract;

final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
