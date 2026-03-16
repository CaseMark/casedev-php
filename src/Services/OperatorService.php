<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\ServiceContracts\OperatorContract;
use CaseDev\Services\Operator\V1Service;

final class OperatorService implements OperatorContract
{
    /**
     * @api
     */
    public OperatorRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new OperatorRawService($client);
        $this->v1 = new V1Service($client);
    }
}
