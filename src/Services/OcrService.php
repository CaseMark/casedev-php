<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\OcrContract;
use Casedev\Services\Ocr\V1Service;

final class OcrService implements OcrContract
{
    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->v1 = new V1Service($client);
    }
}
