<?php

declare(strict_types=1);

namespace Casedev\Services\Actions;

use Casedev\Client;
use Casedev\ServiceContracts\Actions\V1Contract;

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
