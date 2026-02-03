<?php

declare(strict_types=1);

namespace Casedev\Services\Payments\V1;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Payments\V1\TransfersContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class TransfersService implements TransfersContract
{
    /**
     * @api
     */
    public TransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TransfersRawService($client);
    }

    /**
     * @api
     *
     * Create a transfer between payment accounts
     *
     * @param int $amount Amount in cents
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        int $amount,
        string $fromAccountID,
        string $toAccountID,
        ?string $memo = null,
        mixed $metadata = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'fromAccountID' => $fromAccountID,
                'toAccountID' => $toAccountID,
                'memo' => $memo,
                'metadata' => $metadata,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get transfer details by ID
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
     * List transfers with optional filters
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $fromAccountID = null,
        int $limit = 50,
        int $offset = 0,
        ?string $status = null,
        ?string $toAccountID = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'fromAccountID' => $fromAccountID,
                'limit' => $limit,
                'offset' => $offset,
                'status' => $status,
                'toAccountID' => $toAccountID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Approve and execute a pending transfer
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->approve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a pending transfer
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
