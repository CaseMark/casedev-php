<?php

declare(strict_types=1);

namespace Router\Services\Agent\V1;

use Router\Agent\V1\Agents\AgentCreateParams;
use Router\Agent\V1\Agents\AgentCreateParams\Sandbox;
use Router\Agent\V1\Agents\AgentDeleteResponse;
use Router\Agent\V1\Agents\AgentGetResponse;
use Router\Agent\V1\Agents\AgentListResponse;
use Router\Agent\V1\Agents\AgentNewResponse;
use Router\Agent\V1\Agents\AgentUpdateParams;
use Router\Agent\V1\Agents\AgentUpdateResponse;
use Router\Client;
use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;
use Router\ServiceContracts\Agent\V1\AgentsRawContract;

/**
 * @phpstan-import-type SandboxShape from \Router\Agent\V1\Agents\AgentCreateParams\Sandbox
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
final class AgentsRawService implements AgentsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a new agent definition with a scoped API key. The agent can then be used to create and execute runs.
     *
     * @param array{
     *   instructions: string,
     *   name: string,
     *   description?: string,
     *   disabledTools?: list<string>|null,
     *   enabledTools?: list<string>|null,
     *   model?: string,
     *   sandbox?: Sandbox|SandboxShape|null,
     *   vaultIDs?: list<string>|null,
     * }|AgentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AgentNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|AgentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AgentCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'agent/v1/agents',
            body: (object) $parsed,
            options: $options,
            convert: AgentNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieves a single agent definition by ID.
     *
     * @param string $id Agent ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AgentGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['agent/v1/agents/%1$s', $id],
            options: $requestOptions,
            convert: AgentGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Updates an agent definition. Only provided fields are changed.
     *
     * @param string $id Agent ID
     * @param array{
     *   description?: string,
     *   disabledTools?: list<string>|null,
     *   enabledTools?: list<string>|null,
     *   instructions?: string,
     *   model?: string,
     *   name?: string,
     *   sandbox?: mixed,
     *   vaultIDs?: list<string>|null,
     * }|AgentUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AgentUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|AgentUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AgentUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['agent/v1/agents/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: AgentUpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * Lists all active agents for the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AgentListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'agent/v1/agents',
            options: $requestOptions,
            convert: AgentListResponse::class,
        );
    }

    /**
     * @api
     *
     * Soft-deletes an agent and revokes its scoped API key.
     *
     * @param string $id Agent ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AgentDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['agent/v1/agents/%1$s', $id],
            options: $requestOptions,
            convert: AgentDeleteResponse::class,
        );
    }
}
