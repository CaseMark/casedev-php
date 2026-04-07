<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\ServiceContracts\UsageContract;
use CaseDev\Services\Usage\V1Service;

final class UsageService implements UsageContract
{
    /**
     * @api
     */
    public UsageRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new UsageRawService($client);
        $this->v1 = new V1Service($client);
    }
}
