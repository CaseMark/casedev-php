<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\ServiceContracts\WorkerContract;
use CaseDev\Services\Worker\V1Service;

final class WorkerService implements WorkerContract
{
    /**
     * @api
     */
    public WorkerRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WorkerRawService($client);
        $this->v1 = new V1Service($client);
    }
}
