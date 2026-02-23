<?php

declare(strict_types=1);

namespace Router\Services\Vault;

use Router\Client;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;
use Router\ServiceContracts\Vault\GroupsContract;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
final class GroupsService implements GroupsContract
{
    /**
     * @api
     */
    public GroupsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new GroupsRawService($client);
    }

    /**
     * @api
     *
     * Create vault group
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update vault group
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $groupID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($groupID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List vault groups
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete vault group
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $groupID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($groupID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
