<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent\V2;

use CaseDev\Agent\V2\Run\RunCreateParams;
use CaseDev\Agent\V2\Run\RunEventsParams;
use CaseDev\Agent\V2\Run\RunExecResponse;
use CaseDev\Agent\V2\Run\RunGetStatusResponse;
use CaseDev\Agent\V2\Run\RunNewResponse;
use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Contracts\BaseStream;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Agent\V2\RunRawContract;
use CaseDev\SSEStream;

/**
 * Create, manage, and execute AI agents with tool access, sandbox environments, and async run workflows.
 *
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
     * Creates a v2 run in queued state. Call POST /agent/v2/run/:id/exec to start execution on the Daytona runtime.
     *
     * @param array{
     *   agentID: string,
     *   prompt: string,
     *   callbackURL?: string|null,
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
            path: 'agent/v2/run',
            body: (object) $parsed,
            options: $options,
            convert: RunNewResponse::class,
        );
    }

    /**
     * @api
     *
     * @param array{lastEventID?: int}|RunEventsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseStream<string>>
     *
     * @throws APIException
     */
    public function eventsStream(
        string $id,
        array|RunEventsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RunEventsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['agent/v2/run/%1$s/events', $id],
            query: Util::array_transform_keys(
                $parsed,
                ['lastEventID' => 'lastEventId']
            ),
            headers: ['Accept' => 'text/event-stream'],
            options: $options,
            convert: 'string',
            stream: SSEStream::class,
        );
    }

    /**
     * @api
     *
     * Starts execution of a queued v2 run. The agent runs in a durable workflow on a Daytona runtime.
     *
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
            path: ['agent/v2/run/%1$s/exec', $id],
            options: $requestOptions,
            convert: RunExecResponse::class,
        );
    }

    /**
     * @api
     *
     * Full audit trail for a v2 run, with provider-neutral runtime metadata.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
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
            path: ['agent/v2/run/%1$s/details', $id],
            options: $requestOptions,
            convert: 'mixed',
        );
    }

    /**
     * @api
     *
     * Lightweight status poll for a v2 run including neutral runtime metadata.
     *
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
            path: ['agent/v2/run/%1$s/status', $id],
            options: $requestOptions,
            convert: RunGetStatusResponse::class,
        );
    }
}
