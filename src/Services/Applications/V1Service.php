<?php

declare(strict_types=1);

namespace Casedev\Services\Applications;

use Casedev\Client;
use Casedev\ServiceContracts\Applications\V1Contract;
use Casedev\Services\Applications\V1\DeploymentsService;
use Casedev\Services\Applications\V1\ProjectsService;
use Casedev\Services\Applications\V1\WorkflowsService;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @api
     */
    public DeploymentsService $deployments;

    /**
     * @api
     */
    public ProjectsService $projects;

    /**
     * @api
     */
    public WorkflowsService $workflows;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->deployments = new DeploymentsService($client);
        $this->projects = new ProjectsService($client);
        $this->workflows = new WorkflowsService($client);
    }
}
