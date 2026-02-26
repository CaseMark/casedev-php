<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent\V1;

use CaseDev\Agent\V1\Execute\ExecuteCreateParams\Sandbox;
use CaseDev\Agent\V1\Execute\ExecuteNewResponse;
use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Agent\V1\ExecuteContract;

/**
 * @phpstan-import-type SandboxShape from \CaseDev\Agent\V1\Execute\ExecuteCreateParams\Sandbox
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class ExecuteService implements ExecuteContract
{
    /**
     * @api
     */
    public ExecuteRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ExecuteRawService($client);
    }

    /**
     * @api
     *
     * Creates an ephemeral agent and immediately executes a run. Returns the run ID for polling status and results. This is the fastest way to run an agent without managing agent lifecycle.
     *
     * @param string $prompt Task prompt for the agent
     * @param list<string>|null $disabledTools Denylist of tools the agent cannot use
     * @param list<string>|null $enabledTools Allowlist of tools the agent can use
     * @param string|null $guidance Additional context or constraints for this run
     * @param string $instructions System instructions. Defaults to a general-purpose legal assistant prompt if not provided.
     * @param string $model LLM model identifier. Defaults to anthropic/claude-sonnet-4.6
     * @param list<string>|null $objectIDs Scope this run to specific vault object IDs. The agent will only access these objects.
     * @param Sandbox|SandboxShape|null $sandbox Custom sandbox resources (cpu, memoryMiB)
     * @param list<string>|null $vaultIDs Restrict agent to specific vault IDs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $prompt,
        ?array $disabledTools = null,
        ?array $enabledTools = null,
        ?string $guidance = null,
        ?string $instructions = null,
        ?string $model = null,
        ?array $objectIDs = null,
        Sandbox|array|null $sandbox = null,
        ?array $vaultIDs = null,
        RequestOptions|array|null $requestOptions = null,
    ): ExecuteNewResponse {
        $params = Util::removeNulls(
            [
                'prompt' => $prompt,
                'disabledTools' => $disabledTools,
                'enabledTools' => $enabledTools,
                'guidance' => $guidance,
                'instructions' => $instructions,
                'model' => $model,
                'objectIDs' => $objectIDs,
                'sandbox' => $sandbox,
                'vaultIDs' => $vaultIDs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
