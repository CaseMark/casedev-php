<?php

declare(strict_types=1);

namespace Casedev\Services\Payments\V1;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Payments\V1\Parties\PartyCreateParams;
use Casedev\Payments\V1\Parties\PartyCreateParams\Role;
use Casedev\Payments\V1\Parties\PartyCreateParams\Type;
use Casedev\Payments\V1\Parties\PartyListParams;
use Casedev\Payments\V1\Parties\PartyUpdateParams;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Payments\V1\PartiesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class PartiesRawService implements PartiesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new payment party (client, vendor, counsel, etc.)
     *
     * @param array{
     *   name: string,
     *   type: Type|value-of<Type>,
     *   addressLine1?: string,
     *   city?: string,
     *   country?: string,
     *   email?: string,
     *   metadata?: mixed,
     *   phone?: string,
     *   postalCode?: string,
     *   role?: value-of<Role>,
     *   state?: string,
     * }|PartyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|PartyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PartyCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'payments/v1/parties',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get party details by ID
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
            path: ['payments/v1/parties/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Update party details
     *
     * @param array{
     *   addressLine1?: string,
     *   addressLine2?: string,
     *   city?: string,
     *   country?: string,
     *   email?: string,
     *   isActive?: bool,
     *   metadata?: mixed,
     *   name?: string,
     *   notes?: string,
     *   phone?: string,
     *   postalCode?: string,
     *   role?: value-of<PartyUpdateParams\Role>,
     *   state?: string,
     * }|PartyUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|PartyUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PartyUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['payments/v1/parties/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List payment parties with optional filters
     *
     * @param array{
     *   limit?: int, offset?: int, role?: string, type?: string
     * }|PartyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|PartyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PartyListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'payments/v1/parties',
            query: $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List saved payment methods for a party (from Stripe)
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listPaymentMethods(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['payments/v1/parties/%1$s/payment-methods', $id],
            options: $requestOptions,
            convert: null,
        );
    }
}
