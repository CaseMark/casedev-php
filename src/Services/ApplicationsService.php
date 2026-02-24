<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\ServiceContracts\ApplicationsContract;
use CaseDev\Services\Applications\V1Service;

final class ApplicationsService implements ApplicationsContract
{
    /**
     * @api
     */
    public ApplicationsRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ApplicationsRawService($client);
        $this->v1 = new V1Service($client);
    }
}
