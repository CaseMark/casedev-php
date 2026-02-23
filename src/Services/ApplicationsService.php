<?php

declare(strict_types=1);

namespace Router\Services;

use Router\Client;
use Router\ServiceContracts\ApplicationsContract;
use Router\Services\Applications\V1Service;

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
