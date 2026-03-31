<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent\V2;

use CaseDev\Agent\V2\Execute\ExecuteCreateParams\Sandbox;
use CaseDev\Agent\V2\Execute\ExecuteNewResponse;
use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Agent\V2\ExecuteContract;

/**
 * Create, manage, and execute AI agents with tool access, sandbox environments, and async run workflows.
 *
 * @phpstan-import-type SandboxShape from \CaseDev\Agent\V2\Execute\ExecuteCreateParams\Sandbox
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
     * Creates an ephemeral agent and executes it immediately. By default this uses the lightweight synchronous linc runtime on Vercel Sandbox. Set `agentRuntime: true` to opt into the legacy Daytona-backed agent runtime.
     *
     * @param bool|null $agentRuntime set to true to opt into the legacy Daytona-backed agent runtime
     * @param list<string>|null $disabledTools
     * @param list<string>|null $enabledTools
     * @param list<string>|null $objectIDs
     * @param Sandbox|SandboxShape|null $sandbox
     * @param list<string>|null $vaultIDs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $prompt,
        ?bool $agentRuntime = null,
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
                'agentRuntime' => $agentRuntime,
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
