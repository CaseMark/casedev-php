<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\Shares\ShareCreateParams;
use CaseDev\Matters\V1\Shares\ShareCreateParams\Permission;
use CaseDev\Matters\V1\Shares\ShareDeleteParams;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1\SharesRawContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class SharesRawService implements SharesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Grant another organization scoped access to this matter and its primary vault.
     *
     * @param array{
     *   targetOrgID: string,
     *   expiresAt?: \DateTimeInterface|null,
     *   permission?: Permission|value-of<Permission>,
     * }|ShareCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|ShareCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ShareCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['matters/v1/%1$s/shares', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List cross-org shares for a matter. Owner only.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['matters/v1/%1$s/shares', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Revoke a matter share and its linked vault share.
     *
     * @param array{id: string}|ShareDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $shareID,
        array|ShareDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ShareDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['matters/v1/%1$s/shares/%2$s', $id, $shareID],
            options: $options,
            convert: null,
        );
    }
}
