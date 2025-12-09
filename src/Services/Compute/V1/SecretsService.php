<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\Compute\V1\Secrets\SecretCreateParams;
use Casedev\Compute\V1\Secrets\SecretDeleteGroupParams;
use Casedev\Compute\V1\Secrets\SecretListParams;
use Casedev\Compute\V1\Secrets\SecretNewResponse;
use Casedev\Compute\V1\Secrets\SecretRetrieveGroupParams;
use Casedev\Compute\V1\Secrets\SecretUpdateGroupParams;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1\SecretsContract;

final class SecretsService implements SecretsContract
{
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
     *
     * @throws APIException
     */
    public function create(
        array|SecretCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): SecretNewResponse {
        [$parsed, $options] = SecretCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<SecretNewResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'compute/v1/secrets',
            body: (object) $parsed,
            options: $options,
            convert: SecretNewResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve all secret groups for a compute environment. Secret groups organize related secrets (API keys, credentials, etc.) that can be securely accessed by compute jobs during execution.
     *
     * @param array{env?: string}|SecretListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|SecretListParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = SecretListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'get',
            path: 'compute/v1/secrets',
            query: $parsed,
            options: $options,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete an entire secret group or a specific key within a secret group. Automatically syncs the deletion to Modal compute infrastructure. When deleting a specific key, the remaining secrets in the group are re-synced. When deleting the entire group, all secrets and the group itself are removed from both the database and Modal.
     *
     * @param array{env?: string, key?: string}|SecretDeleteGroupParams $params
     *
     * @throws APIException
     */
    public function deleteGroup(
        string $group,
        array|SecretDeleteGroupParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = SecretDeleteGroupParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'delete',
            path: ['compute/v1/secrets/%1$s', $group],
            query: $parsed,
            options: $options,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve the keys (names) of secrets in a specified group within a compute environment. For security reasons, actual secret values are not returned - only the keys and metadata.
     *
     * @param array{env?: string}|SecretRetrieveGroupParams $params
     *
     * @throws APIException
     */
    public function retrieveGroup(
        string $group,
        array|SecretRetrieveGroupParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = SecretRetrieveGroupParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'get',
            path: ['compute/v1/secrets/%1$s', $group],
            query: $parsed,
            options: $options,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Set or update secrets in a compute secret group. Secrets are encrypted with AES-256-GCM and synced to compute infrastructure in real-time. Use this to manage environment variables and API keys for your compute workloads.
     *
     * @param array{
     *   secrets: array<string,string>, env?: string
     * }|SecretUpdateGroupParams $params
     *
     * @throws APIException
     */
    public function updateGroup(
        string $group,
        array|SecretUpdateGroupParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = SecretUpdateGroupParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'put',
            path: ['compute/v1/secrets/%1$s', $group],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );

        return $response->parse();
    }
}
