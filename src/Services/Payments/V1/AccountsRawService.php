<?php

declare(strict_types=1);

namespace Casedev\Services\Payments\V1;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Payments\V1\Accounts\AccountCreateParams;
use Casedev\Payments\V1\Accounts\AccountCreateParams\Type;
use Casedev\Payments\V1\Accounts\AccountGetBalanceResponse;
use Casedev\Payments\V1\Accounts\AccountGetLedgerParams;
use Casedev\Payments\V1\Accounts\AccountGetLedgerResponse;
use Casedev\Payments\V1\Accounts\AccountListParams;
use Casedev\Payments\V1\Accounts\AccountNewResponse;
use Casedev\Payments\V1\Accounts\AccountUpdateParams;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Payments\V1\AccountsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class AccountsRawService implements AccountsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new payment account (trust, operating, escrow, client sub-account, etc.)
     *
     * @param array{
     *   name: string,
     *   type: Type|value-of<Type>,
     *   currency?: string,
     *   matterID?: string,
     *   metadata?: mixed,
     *   parentAccountID?: string,
     * }|AccountCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|AccountCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'payments/v1/accounts',
            body: (object) $parsed,
            options: $options,
            convert: AccountNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Get a payment account by ID
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['payments/v1/accounts/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Update a payment account
     *
     * @param array{
     *   isActive?: bool, metadata?: mixed, name?: string
     * }|AccountUpdateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = AccountUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['payments/v1/accounts/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List all payment accounts for the organization
     *
     * @param array{
     *   limit?: int,
     *   matterID?: string,
     *   offset?: int,
     *   parentAccountID?: string,
     *   type?: string,
     * }|AccountListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|AccountListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'payments/v1/accounts',
            query: Util::array_transform_keys(
                $parsed,
                ['matterID' => 'matter_id', 'parentAccountID' => 'parent_account_id'],
            ),
            options: $options,
            convert: 'mixed',
        );
    }

    /**
     * @api
     *
     * Get the current balance for an account, computed from the ledger
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['payments/v1/accounts/%1$s/balance', $id],
            options: $requestOptions,
            convert: AccountGetBalanceResponse::class,
        );
    }

    /**
     * @api
     *
     * Get ledger entries for a specific account
     *
     * @param array{limit?: int, offset?: int}|AccountGetLedgerParams $params
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
    ): BaseResponse {
        [$parsed, $options] = AccountGetLedgerParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['payments/v1/accounts/%1$s/ledger', $id],
            query: $parsed,
            options: $options,
            convert: AccountGetLedgerResponse::class,
        );
    }
}
