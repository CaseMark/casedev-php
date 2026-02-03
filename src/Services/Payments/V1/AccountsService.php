<?php

declare(strict_types=1);

namespace Casedev\Services\Payments\V1;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Payments\V1\Accounts\AccountCreateParams\Type;
use Casedev\Payments\V1\Accounts\AccountGetBalanceResponse;
use Casedev\Payments\V1\Accounts\AccountGetLedgerResponse;
use Casedev\Payments\V1\Accounts\AccountNewResponse;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Payments\V1\AccountsContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class AccountsService implements AccountsContract
{
    /**
     * @api
     */
    public AccountsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AccountsRawService($client);
    }

    /**
     * @api
     *
     * Create a new payment account (trust, operating, escrow, client sub-account, etc.)
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
    ): AccountNewResponse {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'type' => $type,
                'currency' => $currency,
                'matterID' => $matterID,
                'metadata' => $metadata,
                'parentAccountID' => $parentAccountID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a payment account by ID
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a payment account
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
    ): mixed {
        $params = Util::removeNulls(
            ['isActive' => $isActive, 'metadata' => $metadata, 'name' => $name]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List all payment accounts for the organization
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'limit' => $limit,
                'matterID' => $matterID,
                'offset' => $offset,
                'parentAccountID' => $parentAccountID,
                'type' => $type,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the current balance for an account, computed from the ledger
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getBalance(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AccountGetBalanceResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getBalance($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get ledger entries for a specific account
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
    ): AccountGetLedgerResponse {
        $params = Util::removeNulls(['limit' => $limit, 'offset' => $offset]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getLedger($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
