<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\ProjectsContract;
use Casedev\Services\Projects\V1Service;

final class ProjectsService implements ProjectsContract
{
    /**
     * @api
     */
    public ProjectsRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ProjectsRawService($client);
        $this->v1 = new V1Service($client);
    }
}
