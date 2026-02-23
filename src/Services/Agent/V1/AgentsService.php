<?php

declare(strict_types=1);

namespace Router\Services\Agent\V1;

use Router\Agent\V1\Agents\AgentCreateParams\Sandbox;
use Router\Agent\V1\Agents\AgentDeleteResponse;
use Router\Agent\V1\Agents\AgentGetResponse;
use Router\Agent\V1\Agents\AgentListResponse;
use Router\Agent\V1\Agents\AgentNewResponse;
use Router\Agent\V1\Agents\AgentUpdateResponse;
use Router\Client;
use Router\Core\Exceptions\APIException;
use Router\Core\Util;
use Router\RequestOptions;
use Router\ServiceContracts\Agent\V1\AgentsContract;

/**
 * @phpstan-import-type SandboxShape from \Router\Agent\V1\Agents\AgentCreateParams\Sandbox
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
final class AgentsService implements AgentsContract
{
    /**
     * @api
     */
    public AgentsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AgentsRawService($client);
    }

    /**
     * @api
     *
     * Creates a new agent definition with a scoped API key. The agent can then be used to create and execute runs.
     *
     * @param string $instructions System instructions that define agent behavior
     * @param string $name Display name for the agent
     * @param string $description Optional description of the agent
     * @param list<string>|null $disabledTools Denylist of tools the agent cannot use
     * @param list<string>|null $enabledTools Allowlist of tools the agent can use
     * @param string $model LLM model identifier (e.g. anthropic/claude-sonnet-4.6). Defaults to anthropic/claude-sonnet-4.6
     * @param Sandbox|SandboxShape|null $sandbox Custom sandbox configuration (cpu, memoryMiB)
     * @param list<string>|null $vaultIDs Restrict agent to specific vault IDs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $instructions,
        string $name,
        ?string $description = null,
        ?array $disabledTools = null,
        ?array $enabledTools = null,
        ?string $model = null,
        Sandbox|array|null $sandbox = null,
        ?array $vaultIDs = null,
        RequestOptions|array|null $requestOptions = null,
    ): AgentNewResponse {
        $params = Util::removeNulls(
            [
                'instructions' => $instructions,
                'name' => $name,
                'description' => $description,
                'disabledTools' => $disabledTools,
                'enabledTools' => $enabledTools,
                'model' => $model,
                'sandbox' => $sandbox,
                'vaultIDs' => $vaultIDs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves a single agent definition by ID.
     *
     * @param string $id Agent ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AgentGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Updates an agent definition. Only provided fields are changed.
     *
     * @param string $id Agent ID
     * @param list<string>|null $disabledTools
     * @param list<string>|null $enabledTools
     * @param list<string>|null $vaultIDs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $description = null,
        ?array $disabledTools = null,
        ?array $enabledTools = null,
        ?string $instructions = null,
        ?string $model = null,
        ?string $name = null,
        mixed $sandbox = null,
        ?array $vaultIDs = null,
        RequestOptions|array|null $requestOptions = null,
    ): AgentUpdateResponse {
        $params = Util::removeNulls(
            [
                'description' => $description,
                'disabledTools' => $disabledTools,
                'enabledTools' => $enabledTools,
                'instructions' => $instructions,
                'model' => $model,
                'name' => $name,
                'sandbox' => $sandbox,
                'vaultIDs' => $vaultIDs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lists all active agents for the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): AgentListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Soft-deletes an agent and revokes its scoped API key.
     *
     * @param string $id Agent ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AgentDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
