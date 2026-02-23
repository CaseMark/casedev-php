<?php

declare(strict_types=1);

namespace Router\Services;

use Router\Client;
use Router\ServiceContracts\ComputeContract;
use Router\Services\Compute\V1Service;

final class ComputeService implements ComputeContract
{
    /**
     * @api
     */
    public ComputeRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ComputeRawService($client);
        $this->v1 = new V1Service($client);
    }
}
