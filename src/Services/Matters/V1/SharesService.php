<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\Matters\V1\Shares\ShareCreateParams\Permission;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1\SharesContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class SharesService implements SharesContract
{
    /**
     * @api
     */
    public SharesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SharesRawService($client);
    }

    /**
     * @api
     *
     * Grant another organization scoped access to this matter and its primary vault.
     *
     * @param Permission|value-of<Permission> $permission
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $id,
        string $targetOrgID,
        ?\DateTimeInterface $expiresAt = null,
        Permission|string $permission = 'read',
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'targetOrgID' => $targetOrgID,
                'expiresAt' => $expiresAt,
                'permission' => $permission,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List cross-org shares for a matter. Owner only.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Revoke a matter share and its linked vault share.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $shareID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($shareID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
