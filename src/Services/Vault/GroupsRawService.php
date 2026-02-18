<?php

declare(strict_types=1);

namespace Casedev\Services\Vault;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Vault\GroupsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
     * Create vault group
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'vault/groups',
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Update vault group
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $groupID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['vault/groups/%1$s', $groupID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List vault groups
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
     * Delete vault group
     *
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
