<?php

declare(strict_types=1);

namespace Casedev\Services\Database;

use Casedev\Client;
use Casedev\ServiceContracts\Database\V1Contract;
use Casedev\Services\Database\V1\ProjectsService;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @api
     */
    public ProjectsService $projects;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->projects = new ProjectsService($client);
    }
}
