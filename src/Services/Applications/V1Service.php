<?php

declare(strict_types=1);

namespace CaseDev\Services\Applications;

use CaseDev\Client;
use CaseDev\ServiceContracts\Applications\V1Contract;
use CaseDev\Services\Applications\V1\DeploymentsService;
use CaseDev\Services\Applications\V1\ProjectsService;
use CaseDev\Services\Applications\V1\WorkflowsService;

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
