<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Payments\V1;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Payments\V1\Accounts\AccountCreateParams;
use Casedev\Payments\V1\Accounts\AccountGetBalanceResponse;
use Casedev\Payments\V1\Accounts\AccountGetLedgerParams;
use Casedev\Payments\V1\Accounts\AccountGetLedgerResponse;
use Casedev\Payments\V1\Accounts\AccountListParams;
use Casedev\Payments\V1\Accounts\AccountNewResponse;
use Casedev\Payments\V1\Accounts\AccountUpdateParams;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface AccountsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AccountCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|AccountCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AccountUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|AccountUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AccountListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|AccountListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountGetBalanceResponse>
     *
     * @throws APIException
     */
    public function getBalance(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AccountGetLedgerParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountGetLedgerResponse>
     *
     * @throws APIException
     */
    public function getLedger(
        string $id,
        array|AccountGetLedgerParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
