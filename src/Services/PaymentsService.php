<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\PaymentsContract;
use Casedev\Services\Payments\V1Service;

final class PaymentsService implements PaymentsContract
{
    /**
     * @api
     */
    public PaymentsRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PaymentsRawService($client);
        $this->v1 = new V1Service($client);
    }
}
