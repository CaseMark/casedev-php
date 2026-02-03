<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Payments\V1;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Payments\V1\Ledger\LedgerGetParams;
use Casedev\Payments\V1\Ledger\LedgerListTransactionsParams;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface LedgerRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|LedgerGetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function get(
        array|LedgerGetParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|LedgerListTransactionsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listTransactions(
        array|LedgerListTransactionsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
