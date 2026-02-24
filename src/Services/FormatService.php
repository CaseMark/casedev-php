<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\ServiceContracts\FormatContract;
use CaseDev\Services\Format\V1Service;

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
