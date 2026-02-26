<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent\V1;

use CaseDev\Agent\V1\Execute\ExecuteCreateParams;
use CaseDev\Agent\V1\Execute\ExecuteCreateParams\Sandbox;
use CaseDev\Agent\V1\Execute\ExecuteNewResponse;
use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Agent\V1\ExecuteRawContract;

/**
 * @phpstan-import-type SandboxShape from \CaseDev\Agent\V1\Execute\ExecuteCreateParams\Sandbox
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
     * Creates an ephemeral agent and immediately executes a run. Returns the run ID for polling status and results. This is the fastest way to run an agent without managing agent lifecycle.
     *
     * @param array{
     *   prompt: string,
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
            path: 'agent/v1/execute',
            body: (object) $parsed,
            options: $options,
            convert: ExecuteNewResponse::class,
        );
    }
}
