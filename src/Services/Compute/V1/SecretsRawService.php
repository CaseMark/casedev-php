<?php

declare(strict_types=1);

namespace CaseDev\Services\Compute\V1;

use CaseDev\Client;
use CaseDev\Compute\V1\Secrets\SecretCreateParams;
use CaseDev\Compute\V1\Secrets\SecretDeleteGroupParams;
use CaseDev\Compute\V1\Secrets\SecretDeleteGroupResponse;
use CaseDev\Compute\V1\Secrets\SecretGetGroupResponse;
use CaseDev\Compute\V1\Secrets\SecretListParams;
use CaseDev\Compute\V1\Secrets\SecretListResponse;
use CaseDev\Compute\V1\Secrets\SecretNewResponse;
use CaseDev\Compute\V1\Secrets\SecretRetrieveGroupParams;
use CaseDev\Compute\V1\Secrets\SecretUpdateGroupParams;
use CaseDev\Compute\V1\Secrets\SecretUpdateGroupResponse;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Compute\V1\SecretsRawContract;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class SecretsRawService implements SecretsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a new secret group in a compute environment. Secret groups organize related secrets for use in serverless functions and workflows. If no environment is specified, the group is created in the default environment.
     *
     * **Features:**
     * - Organize secrets by logical groups (e.g., database, APIs, third-party services)
     * - Environment-based isolation
     * - Validation of group names
     * - Conflict detection for existing groups
     *
     * @param array{
     *   name: string, description?: string, env?: string
     * }|SecretCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SecretNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|SecretCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SecretCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'compute/v1/secrets',
            body: (object) $parsed,
            options: $options,
            convert: SecretNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve all secret groups for a compute environment. Secret groups organize related secrets (API keys, credentials, etc.) that can be securely accessed by compute jobs during execution.
     *
     * @param array{env?: string}|SecretListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SecretListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|SecretListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SecretListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'compute/v1/secrets',
            query: $parsed,
            options: $options,
            convert: SecretListResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete an entire secret group or a specific key within a secret group. When deleting a specific key, the remaining secrets in the group are preserved. When deleting the entire group, all secrets and the group itself are removed.
     *
     * @param string $group Name of the secret group
     * @param array{env?: string, key?: string}|SecretDeleteGroupParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SecretDeleteGroupResponse>
     *
     * @throws APIException
     */
    public function deleteGroup(
        string $group,
        array|SecretDeleteGroupParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SecretDeleteGroupParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['compute/v1/secrets/%1$s', $group],
            query: $parsed,
            options: $options,
            convert: SecretDeleteGroupResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve the keys (names) of secrets in a specified group within a compute environment. For security reasons, actual secret values are not returned - only the keys and metadata.
     *
     * @param string $group Name of the secret group to list keys from
     * @param array{env?: string}|SecretRetrieveGroupParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SecretGetGroupResponse>
     *
     * @throws APIException
     */
    public function retrieveGroup(
        string $group,
        array|SecretRetrieveGroupParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SecretRetrieveGroupParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['compute/v1/secrets/%1$s', $group],
            query: $parsed,
            options: $options,
            convert: SecretGetGroupResponse::class,
        );
    }

    /**
     * @api
     *
     * Set or update secrets in a compute secret group. Secrets are encrypted with AES-256-GCM. Use this to manage environment variables and API keys for your compute workloads.
     *
     * @param string $group Name of the secret group
     * @param array{
     *   secrets: array<string,string>, env?: string
     * }|SecretUpdateGroupParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SecretUpdateGroupResponse>
     *
     * @throws APIException
     */
    public function updateGroup(
        string $group,
        array|SecretUpdateGroupParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SecretUpdateGroupParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['compute/v1/secrets/%1$s', $group],
            body: (object) $parsed,
            options: $options,
            convert: SecretUpdateGroupResponse::class,
        );
    }
}
