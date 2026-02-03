<?php

declare(strict_types=1);

namespace Casedev\Services\Payments\V1;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Payments\V1\Holds\HoldApproveParams;
use Casedev\Payments\V1\Holds\HoldCreateParams;
use Casedev\Payments\V1\Holds\HoldCreateParams\ReleaseCondition;
use Casedev\Payments\V1\Holds\HoldListParams;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Payments\V1\HoldsRawContract;

/**
 * @phpstan-import-type ReleaseConditionShape from \Casedev\Payments\V1\Holds\HoldCreateParams\ReleaseCondition
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class HoldsRawService implements HoldsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a hold on funds in an account with release conditions
     *
     * @param array{
     *   accountID: string,
     *   amount: int,
     *   currency?: string,
     *   expiresAt?: \DateTimeInterface,
     *   memo?: string,
     *   metadata?: mixed,
     *   onReleaseAction?: string,
     *   onReleaseConfig?: mixed,
     *   releaseConditions?: list<ReleaseCondition|ReleaseConditionShape>,
     * }|HoldCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|HoldCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = HoldCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'payments/v1/holds',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get hold details by ID
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
            path: ['payments/v1/holds/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List holds with optional filters
     *
     * @param array{
     *   accountID?: string, limit?: int, offset?: int, status?: string
     * }|HoldListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|HoldListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = HoldListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'payments/v1/holds',
            query: Util::array_transform_keys($parsed, ['accountID' => 'account_id']),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Record an approval for a hold release condition
     *
     * @param array{approverID?: string}|HoldApproveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function approve(
        string $id,
        array|HoldApproveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = HoldApproveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['payments/v1/holds/%1$s/approve', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Cancel an active hold
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['payments/v1/holds/%1$s/cancel', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Manually release a hold
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function release(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['payments/v1/holds/%1$s/release', $id],
            options: $requestOptions,
            convert: null,
        );
    }
}
