<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\WorkflowsContract;
use Casedev\Services\Workflows\V1Service;

final class WorkflowsService implements WorkflowsContract
{
    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->v1 = new V1Service($client);
    }
}
