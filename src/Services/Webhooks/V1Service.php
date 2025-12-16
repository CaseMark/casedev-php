<?php

declare(strict_types=1);

namespace Casedev\Services\Webhooks;

use Casedev\Client;
use Casedev\ServiceContracts\Webhooks\V1Contract;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
    }
}
