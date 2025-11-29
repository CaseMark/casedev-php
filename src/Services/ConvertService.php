<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\ConvertContract;
use Casedev\Services\Convert\V1Service;

final class ConvertService implements ConvertContract
{
    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->v1 = new V1Service($client);
    }
}
