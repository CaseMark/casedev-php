<?php

declare(strict_types=1);

namespace Router\Services;

use Router\Client;
use Router\ServiceContracts\FormatContract;
use Router\Services\Format\V1Service;

final class FormatService implements FormatContract
{
    /**
     * @api
     */
    public FormatRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FormatRawService($client);
        $this->v1 = new V1Service($client);
    }
}
