<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent;

use CaseDev\Client;
use CaseDev\ServiceContracts\Agent\V1Contract;
use CaseDev\Services\Agent\V1\AgentsService;
use CaseDev\Services\Agent\V1\ExecuteService;
use CaseDev\Services\Agent\V1\RunService;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @api
     */
    public AgentsService $agents;

    /**
     * @api
     */
    public RunService $run;

    /**
     * @api
     */
    public ExecuteService $execute;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->agents = new AgentsService($client);
        $this->run = new RunService($client);
        $this->execute = new ExecuteService($client);
    }
}
