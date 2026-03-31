<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent;

use CaseDev\Client;
use CaseDev\ServiceContracts\Agent\V2Contract;
use CaseDev\Services\Agent\V2\ChatService;
use CaseDev\Services\Agent\V2\ExecuteService;
use CaseDev\Services\Agent\V2\RunService;

final class V2Service implements V2Contract
{
    /**
     * @api
     */
    public V2RawService $raw;

    /**
     * @api
     */
    public RunService $run;

    /**
     * @api
     */
    public ExecuteService $execute;

    /**
     * @api
     */
    public ChatService $chat;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V2RawService($client);
        $this->run = new RunService($client);
        $this->execute = new ExecuteService($client);
        $this->chat = new ChatService($client);
    }
}
