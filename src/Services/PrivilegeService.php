<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\PrivilegeContract;
use Casedev\Services\Privilege\V1Service;

final class PrivilegeService implements PrivilegeContract
{
    /**
     * @api
     */
    public PrivilegeRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PrivilegeRawService($client);
        $this->v1 = new V1Service($client);
    }
}
