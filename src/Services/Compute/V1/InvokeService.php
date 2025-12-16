<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\ServiceContracts\Compute\V1\InvokeContract;

final class InvokeService implements InvokeContract
{
    /**
     * @api
     */
    public InvokeRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InvokeRawService($client);
    }
}
