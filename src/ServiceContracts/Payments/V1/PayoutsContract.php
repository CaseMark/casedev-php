<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Payments\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\Payments\V1\Payouts\PayoutCreateParams\DestinationType;
use Casedev\Payments\V1\Payouts\PayoutListParams\Status;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface PayoutsContract
{
    /**
     * @api
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
}
