<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Payments\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface ChargesContract
{
    /**
     * @api
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
    ): mixed;

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
    public function list(
        ?string $destinationAccountID = null,
        int $limit = 50,
        int $offset = 0,
        ?string $partyID = null,
        ?string $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): mixed;
}
