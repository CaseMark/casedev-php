<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Payments\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\Payments\V1\Holds\HoldCreateParams\ReleaseCondition;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type ReleaseConditionShape from \Casedev\Payments\V1\Holds\HoldCreateParams\ReleaseCondition
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface HoldsContract
{
    /**
     * @api
     *
     * @param string $accountID Account to hold funds in
     * @param int $amount Amount in cents to hold
     * @param string $onReleaseAction Action to take when released
     * @param list<ReleaseCondition|ReleaseConditionShape> $releaseConditions
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        int $amount,
        string $currency = 'usd',
        ?\DateTimeInterface $expiresAt = null,
        ?string $memo = null,
        mixed $metadata = null,
        ?string $onReleaseAction = null,
        mixed $onReleaseConfig = null,
        ?array $releaseConditions = null,
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
        ?string $accountID = null,
        int $limit = 50,
        int $offset = 0,
        ?string $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $approverID ID of the approver (party or user)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $id,
        ?string $approverID = null,
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function release(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
