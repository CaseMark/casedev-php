<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Payments\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\Payments\V1\Accounts\AccountCreateParams\Type;
use Casedev\Payments\V1\Accounts\AccountGetBalanceResponse;
use Casedev\Payments\V1\Accounts\AccountGetLedgerResponse;
use Casedev\Payments\V1\Accounts\AccountNewResponse;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface AccountsContract
{
    /**
     * @api
     *
     * @param string $name Account name
     * @param Type|value-of<Type> $type Account type
     * @param string $currency Currency code
     * @param string $matterID Associated matter ID
     * @param mixed $metadata Additional metadata
     * @param string $parentAccountID Parent account ID for sub-accounts
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        Type|string $type,
        string $currency = 'usd',
        ?string $matterID = null,
        mixed $metadata = null,
        ?string $parentAccountID = null,
        RequestOptions|array|null $requestOptions = null,
    ): AccountNewResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?bool $isActive = null,
        mixed $metadata = null,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param int $limit Max results to return
     * @param string $matterID Filter by matter ID
     * @param int $offset Offset for pagination
     * @param string $parentAccountID Filter by parent account
     * @param string $type Filter by account type
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        int $limit = 50,
        ?string $matterID = null,
        int $offset = 0,
        ?string $parentAccountID = null,
        ?string $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getBalance(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AccountGetBalanceResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getLedger(
        string $id,
        int $limit = 50,
        int $offset = 0,
        RequestOptions|array|null $requestOptions = null,
    ): AccountGetLedgerResponse;
}
