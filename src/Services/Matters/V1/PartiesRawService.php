<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\Parties\PartyCreateParams;
use CaseDev\Matters\V1\Parties\PartyCreateParams\Type;
use CaseDev\Matters\V1\Parties\PartyListParams;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1\PartiesRawContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
     * Create a reusable legal party for the authenticated organization.
     *
     * @param array{
     *   name: string,
     *   addresses?: list<array<string,mixed>>,
     *   customFields?: array<string,mixed>|null,
     *   email?: string,
     *   metadata?: array<string,mixed>,
     *   notes?: string|null,
     *   phone?: string,
     *   type?: Type|value-of<Type>,
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
            path: 'matters/v1/parties',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get a reusable legal party by ID.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $partyID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['matters/v1/parties/%1$s', $partyID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Update a reusable legal party.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $partyID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['matters/v1/parties/%1$s', $partyID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List reusable legal parties for the authenticated organization.
     *
     * @param array{
     *   email?: string,
     *   query?: string,
     *   type?: PartyListParams\Type|value-of<PartyListParams\Type>,
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
            path: 'matters/v1/parties',
            query: $parsed,
            options: $options,
            convert: null,
        );
    }
}
