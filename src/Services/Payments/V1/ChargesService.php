<?php

declare(strict_types=1);

namespace Casedev\Services\Payments\V1;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Payments\V1\ChargesContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class ChargesService implements ChargesContract
{
    /**
     * @api
     */
    public ChargesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ChargesRawService($client);
    }

    /**
     * @api
     *
     * Create a charge (payment request) to collect money from a party
     *
     * @param int $amount Amount in cents
     * @param string $destinationAccountID Account to receive funds
     * @param string $partyID Party to charge
     * @param list<string> $paymentMethods
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        int $amount,
        string $destinationAccountID,
        string $partyID,
        string $currency = 'usd',
        ?string $description = null,
        mixed $metadata = null,
        array $paymentMethods = ['card', 'ach'],
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'destinationAccountID' => $destinationAccountID,
                'partyID' => $partyID,
                'currency' => $currency,
                'description' => $description,
                'metadata' => $metadata,
                'paymentMethods' => $paymentMethods,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get charge details by ID
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
     * List charges with optional filters
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $destinationAccountID = null,
        int $limit = 50,
        int $offset = 0,
        ?string $partyID = null,
        ?string $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'destinationAccountID' => $destinationAccountID,
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
     * Cancel a pending charge before payment is collected
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

    /**
     * @api
     *
     * Refund a succeeded charge (full or partial)
     *
     * @param int $amount Amount to refund in cents. If not provided, full refund.
     * @param string $reason Reason for refund
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function refund(
        string $id,
        ?int $amount = null,
        ?string $reason = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['amount' => $amount, 'reason' => $reason]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->refund($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
