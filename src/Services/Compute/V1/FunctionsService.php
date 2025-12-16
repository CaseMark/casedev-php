<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\ServiceContracts\Compute\V1\FunctionsContract;

final class FunctionsService implements FunctionsContract
{
    /**
     * @api
     */
    public FunctionsRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FunctionsRawService($client);
    }
}
