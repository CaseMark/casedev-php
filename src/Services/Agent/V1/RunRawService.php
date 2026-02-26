<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent\V1;

use CaseDev\Agent\V1\Run\RunCancelResponse;
use CaseDev\Agent\V1\Run\RunCreateParams;
use CaseDev\Agent\V1\Run\RunExecResponse;
use CaseDev\Agent\V1\Run\RunGetDetailsResponse;
use CaseDev\Agent\V1\Run\RunGetStatusResponse;
use CaseDev\Agent\V1\Run\RunNewResponse;
use CaseDev\Agent\V1\Run\RunWatchParams;
use CaseDev\Agent\V1\Run\RunWatchResponse;
use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Agent\V1\RunRawContract;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class RunRawService implements RunRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a run in queued state. Call POST /agent/v1/run/:id/exec to start execution.
     *
     * @param array{
     *   agentID: string,
     *   prompt: string,
     *   guidance?: string|null,
     *   model?: string|null,
     *   objectIDs?: list<string>|null,
     * }|RunCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RunNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|RunCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RunCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'agent/v1/run',
            body: (object) $parsed,
            options: $options,
            convert: RunNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Cancels a running or queued run. Idempotent — cancelling a finished run returns its current status.
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RunCancelResponse>
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['agent/v1/run/%1$s/cancel', $id],
            options: $requestOptions,
            convert: RunCancelResponse::class,
        );
    }

    /**
     * @api
     *
     * Starts execution of a queued run. The agent runs in a durable workflow — poll /run/:id/status for progress.
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RunExecResponse>
     *
     * @throws APIException
     */
    public function exec(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['agent/v1/run/%1$s/exec', $id],
            options: $requestOptions,
            convert: RunExecResponse::class,
        );
    }

    /**
     * @api
     *
     * Full audit trail for a run including output, steps (tool calls, text), and token usage.
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RunGetDetailsResponse>
     *
     * @throws APIException
     */
    public function getDetails(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['agent/v1/run/%1$s/details', $id],
            options: $requestOptions,
            convert: RunGetDetailsResponse::class,
        );
    }

    /**
     * @api
     *
     * Lightweight status poll for a run. Use /run/:id/details for the full audit trail.
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RunGetStatusResponse>
     *
     * @throws APIException
     */
    public function getStatus(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['agent/v1/run/%1$s/status', $id],
            options: $requestOptions,
            convert: RunGetStatusResponse::class,
        );
    }

    /**
     * @api
     *
     * Register a callback URL to receive notifications when the run completes. URL must use https and must not point to a private network.
     *
     * @param string $id Run ID
     * @param array{callbackURL: string}|RunWatchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RunWatchResponse>
     *
     * @throws APIException
     */
    public function watch(
        string $id,
        array|RunWatchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RunWatchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['agent/v1/run/%1$s/watch', $id],
            body: (object) $parsed,
            options: $options,
            convert: RunWatchResponse::class,
        );
    }
}
