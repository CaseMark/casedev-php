<?php

declare(strict_types=1);

namespace Casedev\Services\Payments\V1;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Payments\V1\Ledger\LedgerGetParams;
use Casedev\Payments\V1\Ledger\LedgerListTransactionsParams;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Payments\V1\LedgerRawContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class LedgerRawService implements LedgerRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * List ledger entries with optional filters by account, transaction, or date range
     *
     * @param array{
     *   accountID?: string, limit?: int, offset?: int, transactionID?: string
     * }|LedgerGetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function get(
        array|LedgerGetParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LedgerGetParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'payments/v1/ledger',
            query: Util::array_transform_keys(
                $parsed,
                ['accountID' => 'account_id', 'transactionID' => 'transaction_id'],
            ),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Query ledger transactions with optional filters
     *
     * @param array{
     *   endDate?: \DateTimeInterface,
     *   limit?: int,
     *   offset?: int,
     *   referenceID?: string,
     *   referenceType?: string,
     *   startDate?: \DateTimeInterface,
     * }|LedgerListTransactionsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listTransactions(
        array|LedgerListTransactionsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LedgerListTransactionsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'payments/v1/ledger/transactions',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'endDate' => 'end_date',
                    'referenceID' => 'reference_id',
                    'referenceType' => 'reference_type',
                    'startDate' => 'start_date',
                ],
            ),
            options: $options,
            convert: null,
        );
    }
}
