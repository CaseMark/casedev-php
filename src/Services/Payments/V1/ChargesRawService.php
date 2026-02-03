<?php

declare(strict_types=1);

namespace Casedev\Services\Payments\V1;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Payments\V1\Charges\ChargeCreateParams;
use Casedev\Payments\V1\Charges\ChargeListParams;
use Casedev\Payments\V1\Charges\ChargeRefundParams;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Payments\V1\ChargesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class ChargesRawService implements ChargesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a charge (payment request) to collect money from a party
     *
     * @param array{
     *   amount: int,
     *   destinationAccountID: string,
     *   partyID: string,
     *   currency?: string,
     *   description?: string,
     *   metadata?: mixed,
     *   paymentMethods?: list<string>,
     * }|ChargeCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|ChargeCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChargeCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'payments/v1/charges',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get charge details by ID
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
            path: ['payments/v1/charges/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List charges with optional filters
     *
     * @param array{
     *   destinationAccountID?: string,
     *   limit?: int,
     *   offset?: int,
     *   partyID?: string,
     *   status?: string,
     * }|ChargeListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|ChargeListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChargeListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'payments/v1/charges',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'destinationAccountID' => 'destination_account_id',
                    'partyID' => 'party_id',
                ],
            ),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Cancel a pending charge before payment is collected
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
            path: ['payments/v1/charges/%1$s/cancel', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Refund a succeeded charge (full or partial)
     *
     * @param array{amount?: int, reason?: string}|ChargeRefundParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function refund(
        string $id,
        array|ChargeRefundParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChargeRefundParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['payments/v1/charges/%1$s/refund', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }
}
