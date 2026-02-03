<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Payments\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface LedgerContract
{
    /**
     * @api
     *
     * @param string $accountID Filter by account
     * @param string $transactionID Filter by transaction
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        ?string $accountID = null,
        int $limit = 50,
        int $offset = 0,
        ?string $transactionID = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $referenceID Filter by reference ID
     * @param string $referenceType Filter by reference type (transfer, charge, payout, etc.)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listTransactions(
        ?\DateTimeInterface $endDate = null,
        int $limit = 50,
        int $offset = 0,
        ?string $referenceID = null,
        ?string $referenceType = null,
        ?\DateTimeInterface $startDate = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
