<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\LegalContract;
use Casedev\Services\Legal\V1Service;

final class LegalService implements LegalContract
{
    /**
     * @api
     */
    public LegalRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LegalRawService($client);
        $this->v1 = new V1Service($client);
    }
}
