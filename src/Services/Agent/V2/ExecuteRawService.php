<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent\V2;

use CaseDev\Agent\V2\Execute\ExecuteCreateParams;
use CaseDev\Agent\V2\Execute\ExecuteCreateParams\Sandbox;
use CaseDev\Agent\V2\Execute\ExecuteNewResponse;
use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Agent\V2\ExecuteRawContract;

/**
 * Create, manage, and execute AI agents with tool access, sandbox environments, and async run workflows.
 *
 * @phpstan-import-type SandboxShape from \CaseDev\Agent\V2\Execute\ExecuteCreateParams\Sandbox
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class ExecuteRawService implements ExecuteRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates an ephemeral agent and executes it immediately. By default this uses the lightweight synchronous linc runtime on Vercel Sandbox. Set `agentRuntime: true` to opt into the legacy Daytona-backed agent runtime.
     *
     * @param array{
     *   prompt: string,
     *   agentRuntime?: bool|null,
     *   disabledTools?: list<string>|null,
     *   enabledTools?: list<string>|null,
     *   guidance?: string|null,
     *   instructions?: string,
     *   model?: string,
     *   objectIDs?: list<string>|null,
     *   sandbox?: Sandbox|SandboxShape|null,
     *   vaultIDs?: list<string>|null,
     * }|ExecuteCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ExecuteNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|ExecuteCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExecuteCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'agent/v2/execute',
            body: (object) $parsed,
            options: $options,
            convert: ExecuteNewResponse::class,
        );
    }
}
