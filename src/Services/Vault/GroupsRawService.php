<?php

declare(strict_types=1);

namespace CaseDev\Services\Vault;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Vault\GroupsRawContract;
use CaseDev\Vault\Groups\GroupCreateParams;
use CaseDev\Vault\Groups\GroupUpdateParams;

/**
 * Secure document storage with semantic search and GraphRAG.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class GroupsRawService implements GroupsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a vault group for organizing vaults and applying group-scoped access controls. Group-scoped API keys cannot create or manage vault groups.
     *
     * @param array{name: string, description?: string}|GroupCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|GroupCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = GroupCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'vault/groups',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Updates a vault group for the authenticated organization. Only provided fields are changed, and setting description to null removes the current description.
     *
     * @param string $groupID Vault group ID
     * @param array{description?: string|null, name?: string}|GroupUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $groupID,
        array|GroupUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = GroupUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['vault/groups/%1$s', $groupID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Lists vault groups visible to the authenticated organization. Group-scoped API keys only receive groups within their allowed scope.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'vault/groups',
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Soft-deletes a vault group that no longer has any active vaults assigned. This operation is blocked when the group still contains vaults.
     *
     * @param string $groupID Vault group ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $groupID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['vault/groups/%1$s', $groupID],
            options: $requestOptions,
            convert: null,
        );
    }
}
