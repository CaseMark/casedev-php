<?php

declare(strict_types=1);

namespace Casedev\Services\Payments\V1;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Payments\V1\Transfers\TransferCreateParams;
use Casedev\Payments\V1\Transfers\TransferListParams;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Payments\V1\TransfersRawContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class TransfersRawService implements TransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a transfer between payment accounts
     *
     * @param array{
     *   amount: int,
     *   fromAccountID: string,
     *   toAccountID: string,
     *   memo?: string,
     *   metadata?: mixed,
     * }|TransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|TransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TransferCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'payments/v1/transfers',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get transfer details by ID
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
            path: ['payments/v1/transfers/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List transfers with optional filters
     *
     * @param array{
     *   fromAccountID?: string,
     *   limit?: int,
     *   offset?: int,
     *   status?: string,
     *   toAccountID?: string,
     * }|TransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|TransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TransferListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'payments/v1/transfers',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'fromAccountID' => 'from_account_id', 'toAccountID' => 'to_account_id',
                ],
            ),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Approve and execute a pending transfer
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function approve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['payments/v1/transfers/%1$s/approve', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Cancel a pending transfer
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
            path: ['payments/v1/transfers/%1$s/cancel', $id],
            options: $requestOptions,
            convert: null,
        );
    }
}
