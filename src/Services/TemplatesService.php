<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\TemplatesContract;
use Casedev\Services\Templates\V1Service;

final class TemplatesService implements TemplatesContract
{
    /**
     * @api
     */
    public TemplatesRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TemplatesRawService($client);
        $this->v1 = new V1Service($client);
    }
}
