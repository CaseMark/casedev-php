<?php

declare(strict_types=1);

namespace Casedev\Services\Payments\V1;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Payments\V1\Holds\HoldCreateParams\ReleaseCondition;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Payments\V1\HoldsContract;

/**
 * @phpstan-import-type ReleaseConditionShape from \Casedev\Payments\V1\Holds\HoldCreateParams\ReleaseCondition
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class HoldsService implements HoldsContract
{
    /**
     * @api
     */
    public HoldsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new HoldsRawService($client);
    }

    /**
     * @api
     *
     * Create a hold on funds in an account with release conditions
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'amount' => $amount,
                'currency' => $currency,
                'expiresAt' => $expiresAt,
                'memo' => $memo,
                'metadata' => $metadata,
                'onReleaseAction' => $onReleaseAction,
                'onReleaseConfig' => $onReleaseConfig,
                'releaseConditions' => $releaseConditions,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get hold details by ID
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
     * List holds with optional filters
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'limit' => $limit,
                'offset' => $offset,
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
     * Record an approval for a hold release condition
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
    ): mixed {
        $params = Util::removeNulls(['approverID' => $approverID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->approve($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel an active hold
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
     * Manually release a hold
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function release(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->release($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
