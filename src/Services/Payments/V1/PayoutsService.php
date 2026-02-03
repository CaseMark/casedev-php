<?php

declare(strict_types=1);

namespace Casedev\Services\Payments\V1;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Payments\V1\Payouts\PayoutCreateParams\DestinationType;
use Casedev\Payments\V1\Payouts\PayoutListParams\Status;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Payments\V1\PayoutsContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class PayoutsService implements PayoutsContract
{
    /**
     * @api
     */
    public PayoutsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PayoutsRawService($client);
    }

    /**
     * @api
     *
     * Create a payout to send money to an external bank account
     *
     * @param int $amount Amount in cents
     * @param DestinationType|value-of<DestinationType> $destinationType
     * @param string $fromAccountID Source account
     * @param string $partyID Recipient party (optional)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        int $amount,
        DestinationType|string $destinationType,
        string $fromAccountID,
        string $currency = 'usd',
        ?string $memo = null,
        mixed $metadata = null,
        ?string $partyID = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'destinationType' => $destinationType,
                'fromAccountID' => $fromAccountID,
                'currency' => $currency,
                'memo' => $memo,
                'metadata' => $metadata,
                'partyID' => $partyID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get payout details by ID
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
     * List payouts with optional filters
     *
     * @param Status|value-of<Status> $status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $fromAccountID = null,
        int $limit = 50,
        int $offset = 0,
        ?string $partyID = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'fromAccountID' => $fromAccountID,
                'limit' => $limit,
                'offset' => $offset,
                'partyID' => $partyID,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a pending payout before it is processed
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
