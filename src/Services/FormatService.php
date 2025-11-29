<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\FormatContract;
use Casedev\Services\Format\V1Service;

final class FormatService implements FormatContract
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
