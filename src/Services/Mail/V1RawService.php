<?php

declare(strict_types=1);

namespace CaseDev\Services\Mail;

use CaseDev\Client;
use CaseDev\ServiceContracts\Mail\V1RawContract;

final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
