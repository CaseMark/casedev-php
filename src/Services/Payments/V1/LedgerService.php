<?php

declare(strict_types=1);

namespace Casedev\Services\Payments\V1;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Payments\V1\LedgerContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class LedgerService implements LedgerContract
{
    /**
     * @api
     */
    public LedgerRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LedgerRawService($client);
    }

    /**
     * @api
     *
     * List ledger entries with optional filters by account, transaction, or date range
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'limit' => $limit,
                'offset' => $offset,
                'transactionID' => $transactionID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->get(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Query ledger transactions with optional filters
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'endDate' => $endDate,
                'limit' => $limit,
                'offset' => $offset,
                'referenceID' => $referenceID,
                'referenceType' => $referenceType,
                'startDate' => $startDate,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listTransactions(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
