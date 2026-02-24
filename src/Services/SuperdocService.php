<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\ServiceContracts\SuperdocContract;
use CaseDev\Services\Superdoc\V1Service;

final class SuperdocService implements SuperdocContract
{
    /**
     * @api
     */
    public SuperdocRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SuperdocRawService($client);
        $this->v1 = new V1Service($client);
    }
}
