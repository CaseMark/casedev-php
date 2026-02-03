<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\DatabaseContract;
use Casedev\Services\Database\V1Service;

final class DatabaseService implements DatabaseContract
{
    /**
     * @api
     */
    public DatabaseRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DatabaseRawService($client);
        $this->v1 = new V1Service($client);
    }
}
