<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\ServiceContracts\AgentContract;
use CaseDev\Services\Agent\V1Service;

final class AgentService implements AgentContract
{
    /**
     * @api
     */
    public AgentRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AgentRawService($client);
        $this->v1 = new V1Service($client);
    }
}
