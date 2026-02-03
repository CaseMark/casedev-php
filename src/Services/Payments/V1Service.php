<?php

declare(strict_types=1);

namespace Casedev\Services\Payments;

use Casedev\Client;
use Casedev\ServiceContracts\Payments\V1Contract;
use Casedev\Services\Payments\V1\AccountsService;
use Casedev\Services\Payments\V1\ChargesService;
use Casedev\Services\Payments\V1\HoldsService;
use Casedev\Services\Payments\V1\LedgerService;
use Casedev\Services\Payments\V1\PartiesService;
use Casedev\Services\Payments\V1\PayoutsService;
use Casedev\Services\Payments\V1\TransfersService;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @api
     */
    public AccountsService $accounts;

    /**
     * @api
     */
    public ChargesService $charges;

    /**
     * @api
     */
    public HoldsService $holds;

    /**
     * @api
     */
    public LedgerService $ledger;

    /**
     * @api
     */
    public PartiesService $parties;

    /**
     * @api
     */
    public PayoutsService $payouts;

    /**
     * @api
     */
    public TransfersService $transfers;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->accounts = new AccountsService($client);
        $this->charges = new ChargesService($client);
        $this->holds = new HoldsService($client);
        $this->ledger = new LedgerService($client);
        $this->parties = new PartiesService($client);
        $this->payouts = new PayoutsService($client);
        $this->transfers = new TransfersService($client);
    }
}
