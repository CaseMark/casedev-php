<?php

declare(strict_types=1);

namespace Router\Services\Agent;

use Router\Client;
use Router\ServiceContracts\Agent\V1Contract;
use Router\Services\Agent\V1\AgentsService;
use Router\Services\Agent\V1\RunService;

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
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->agents = new AgentsService($client);
        $this->run = new RunService($client);
    }
}
