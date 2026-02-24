<?php

declare(strict_types=1);

namespace CaseDev\Services\Compute\V1;

use CaseDev\Client;
use CaseDev\Compute\V1\Secrets\SecretDeleteGroupResponse;
use CaseDev\Compute\V1\Secrets\SecretGetGroupResponse;
use CaseDev\Compute\V1\Secrets\SecretListResponse;
use CaseDev\Compute\V1\Secrets\SecretNewResponse;
use CaseDev\Compute\V1\Secrets\SecretUpdateGroupResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Compute\V1\SecretsContract;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class SecretsService implements SecretsContract
{
    /**
     * @api
     */
    public SecretsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SecretsRawService($client);
    }

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
     * @param string $name Unique name for the secret group. Must contain only letters, numbers, hyphens, and underscores.
     * @param string $description Optional description of the secret group's purpose
     * @param string $env Environment name where the secret group will be created. Uses default environment if not specified.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?string $description = null,
        ?string $env = null,
        RequestOptions|array|null $requestOptions = null,
    ): SecretNewResponse {
        $params = Util::removeNulls(
            ['name' => $name, 'description' => $description, 'env' => $env]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve all secret groups for a compute environment. Secret groups organize related secrets (API keys, credentials, etc.) that can be securely accessed by compute jobs during execution.
     *
     * @param string $env Environment name to list secret groups for. If not specified, uses the default environment.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $env = null,
        RequestOptions|array|null $requestOptions = null
    ): SecretListResponse {
        $params = Util::removeNulls(['env' => $env]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete an entire secret group or a specific key within a secret group. When deleting a specific key, the remaining secrets in the group are preserved. When deleting the entire group, all secrets and the group itself are removed.
     *
     * @param string $group Name of the secret group
     * @param string $env Environment name. If not provided, uses the default environment
     * @param string $key Specific key to delete within the group. If not provided, the entire group is deleted
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function deleteGroup(
        string $group,
        ?string $env = null,
        ?string $key = null,
        RequestOptions|array|null $requestOptions = null,
    ): SecretDeleteGroupResponse {
        $params = Util::removeNulls(['env' => $env, 'key' => $key]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->deleteGroup($group, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve the keys (names) of secrets in a specified group within a compute environment. For security reasons, actual secret values are not returned - only the keys and metadata.
     *
     * @param string $group Name of the secret group to list keys from
     * @param string $env Environment name. If not specified, uses the default environment
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveGroup(
        string $group,
        ?string $env = null,
        RequestOptions|array|null $requestOptions = null,
    ): SecretGetGroupResponse {
        $params = Util::removeNulls(['env' => $env]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveGroup($group, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Set or update secrets in a compute secret group. Secrets are encrypted with AES-256-GCM. Use this to manage environment variables and API keys for your compute workloads.
     *
     * @param string $group Name of the secret group
     * @param array<string,string> $secrets Key-value pairs of secrets to set
     * @param string $env Environment name (optional, uses default if not specified)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateGroup(
        string $group,
        array $secrets,
        ?string $env = null,
        RequestOptions|array|null $requestOptions = null,
    ): SecretUpdateGroupResponse {
        $params = Util::removeNulls(['secrets' => $secrets, 'env' => $env]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updateGroup($group, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
