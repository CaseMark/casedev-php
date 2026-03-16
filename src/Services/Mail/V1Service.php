<?php

declare(strict_types=1);

namespace CaseDev\Services\Mail;

use CaseDev\Client;
use CaseDev\ServiceContracts\Mail\V1Contract;
use CaseDev\Services\Mail\V1\InboxesService;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @api
     */
    public InboxesService $inboxes;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->inboxes = new InboxesService($client);
    }
}
