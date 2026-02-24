<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Compute\V1;

use CaseDev\Compute\V1\Secrets\SecretDeleteGroupResponse;
use CaseDev\Compute\V1\Secrets\SecretGetGroupResponse;
use CaseDev\Compute\V1\Secrets\SecretListResponse;
use CaseDev\Compute\V1\Secrets\SecretNewResponse;
use CaseDev\Compute\V1\Secrets\SecretUpdateGroupResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface SecretsContract
{
    /**
     * @api
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
    ): SecretNewResponse;

    /**
     * @api
     *
     * @param string $env Environment name to list secret groups for. If not specified, uses the default environment.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $env = null,
        RequestOptions|array|null $requestOptions = null
    ): SecretListResponse;

    /**
     * @api
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
    ): SecretDeleteGroupResponse;

    /**
     * @api
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
    ): SecretGetGroupResponse;

    /**
     * @api
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
    ): SecretUpdateGroupResponse;
}
