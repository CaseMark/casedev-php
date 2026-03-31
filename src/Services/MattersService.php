<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\ServiceContracts\MattersContract;
use CaseDev\Services\Matters\V1Service;

final class MattersService implements MattersContract
{
    /**
     * @api
     */
    public MattersRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MattersRawService($client);
        $this->v1 = new V1Service($client);
    }
}
