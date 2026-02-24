<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\ServiceContracts\TranslateContract;
use CaseDev\Services\Translate\V1Service;

final class TranslateService implements TranslateContract
{
    /**
     * @api
     */
    public TranslateRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TranslateRawService($client);
        $this->v1 = new V1Service($client);
    }
}
