<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\MemoryContract;
use Casedev\Services\Memory\V1Service;

final class MemoryService implements MemoryContract
{
    /**
     * @api
     */
    public MemoryRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MemoryRawService($client);
        $this->v1 = new V1Service($client);
    }
}
