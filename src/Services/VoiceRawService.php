<?php

declare(strict_types=1);

namespace Router\Services;

use Router\Client;
use Router\ServiceContracts\VoiceRawContract;

final class VoiceRawService implements VoiceRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
