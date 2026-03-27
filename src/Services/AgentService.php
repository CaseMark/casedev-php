<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\ServiceContracts\AgentContract;
use CaseDev\Services\Agent\V1Service;
use CaseDev\Services\Agent\V2Service;

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
     * @api
     */
    public V2Service $v2;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AgentRawService($client);
        $this->v1 = new V1Service($client);
        $this->v2 = new V2Service($client);
    }
}
