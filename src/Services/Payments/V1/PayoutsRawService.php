<?php

declare(strict_types=1);

namespace Casedev\Services\Payments\V1;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Payments\V1\Payouts\PayoutCreateParams;
use Casedev\Payments\V1\Payouts\PayoutCreateParams\DestinationType;
use Casedev\Payments\V1\Payouts\PayoutListParams;
use Casedev\Payments\V1\Payouts\PayoutListParams\Status;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Payments\V1\PayoutsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class PayoutsRawService implements PayoutsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a payout to send money to an external bank account
     *
     * @param array{
     *   amount: int,
     *   destinationType: DestinationType|value-of<DestinationType>,
     *   fromAccountID: string,
     *   currency?: string,
     *   memo?: string,
     *   metadata?: mixed,
     *   partyID?: string,
     * }|PayoutCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|PayoutCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PayoutCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'payments/v1/payouts',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get payout details by ID
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
            path: ['payments/v1/payouts/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List payouts with optional filters
     *
     * @param array{
     *   fromAccountID?: string,
     *   limit?: int,
     *   offset?: int,
     *   partyID?: string,
     *   status?: Status|value-of<Status>,
     * }|PayoutListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|PayoutListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PayoutListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'payments/v1/payouts',
            query: Util::array_transform_keys(
                $parsed,
                ['fromAccountID' => 'from_account_id', 'partyID' => 'party_id']
            ),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Cancel a pending payout before it is processed
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
            path: ['payments/v1/payouts/%1$s/cancel', $id],
            options: $requestOptions,
            convert: null,
        );
    }
}
