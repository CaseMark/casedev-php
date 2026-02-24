<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\ServiceContracts\OcrContract;
use CaseDev\Services\Ocr\V1Service;

final class OcrService implements OcrContract
{
    /**
     * @api
     */
    public OcrRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new OcrRawService($client);
        $this->v1 = new V1Service($client);
    }
}
