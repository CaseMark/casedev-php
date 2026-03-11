<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent\V1;

use CaseDev\Agent\V1\Chat\ChatCancelResponse;
use CaseDev\Agent\V1\Chat\ChatCreateParams;
use CaseDev\Agent\V1\Chat\ChatDeleteResponse;
use CaseDev\Agent\V1\Chat\ChatNewResponse;
use CaseDev\Agent\V1\Chat\ChatReplyToQuestionParams;
use CaseDev\Agent\V1\Chat\ChatRespondParams;
use CaseDev\Agent\V1\Chat\ChatSendMessageParams;
use CaseDev\Agent\V1\Chat\ChatSendMessageParams\Part;
use CaseDev\Agent\V1\Chat\ChatStreamParams;
use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Contracts\BaseStream;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Agent\V1\ChatRawContract;
use CaseDev\SSEStream;

/**
 * Create, manage, and execute AI agents with tool access, sandbox environments, and async run workflows.
 *
 * @phpstan-import-type PartShape from \CaseDev\Agent\V1\Chat\ChatSendMessageParams\Part
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 * @phpstan-import-type PartShape from \CaseDev\Agent\V1\Chat\ChatRespondParams\Part as PartShape1
 */
final class ChatRawService implements ChatRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a persistent OpenCode chat session in a Modal sandbox. Session state is retained and can be resumed across requests.
     *
     * @param array{
     *   idleTimeoutMs?: int|null,
     *   model?: string|null,
     *   title?: string,
     *   vaultIDs?: list<string>|null,
     * }|ChatCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ChatNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|ChatCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'agent/v1/chat',
            body: (object) $parsed,
            options: $options,
            convert: ChatNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Snapshots and terminates the active sandbox (if any), then marks the chat as ended.
     *
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ChatDeleteResponse>
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
            path: ['agent/v1/chat/%1$s', $id],
            options: $requestOptions,
            convert: ChatDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Aborts the active OpenCode generation for this chat session.
     *
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ChatCancelResponse>
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
            path: ['agent/v1/chat/%1$s/cancel', $id],
            options: $requestOptions,
            convert: ChatCancelResponse::class,
        );
    }

    /**
     * @api
     *
     * Answers a pending OpenCode question for the chat session bound to this agent chat.
     *
     * @param string $requestID Path param: Pending question request ID
     * @param array{
     *   id: string, answers: list<list<string>>
     * }|ChatReplyToQuestionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function replyToQuestion(
        string $requestID,
        array|ChatReplyToQuestionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatReplyToQuestionParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['agent/v1/chat/%1$s/question/%2$s/reply', $id, $requestID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Streams a single assistant turn as normalized SSE events with stable turn, message, and part IDs. Emits events: `turn.started`, `turn.status`, `message.created`, `message.part.updated`, `message.completed`, `session.usage`, `turn.completed`.
     *
     * **When to use this endpoint:** Recommended for building custom chat UIs that need real-time streaming progress. This is the primary streaming endpoint for new integrations.
     *
     * **Alternatives:**
     * - `POST /chat/:id/message` — synchronous, returns complete response as JSON (best for server-to-server)
     *
     * @param string $id Chat session ID
     * @param array{
     *   parts?: list<ChatRespondParams\Part|PartShape1>
     * }|ChatRespondParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function respond(
        string $id,
        array|ChatRespondParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatRespondParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['agent/v1/chat/%1$s/respond', $id],
            headers: ['Accept' => 'text/event-stream'],
            body: (object) $parsed,
            options: $options,
            convert: 'string',
        );
    }

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param array{
     *   parts?: list<ChatRespondParams\Part|PartShape1>
     * }|ChatRespondParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseStream<string>>
     *
     * @throws APIException
     */
    public function respondStream(
        string $id,
        array|ChatRespondParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatRespondParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['agent/v1/chat/%1$s/respond', $id],
            headers: ['Accept' => 'text/event-stream'],
            body: (object) $parsed,
            options: $options,
            convert: 'string',
            stream: SSEStream::class,
        );
    }

    /**
     * @api
     *
     * Sends a message and returns the complete response as a single JSON body. Blocks until the agent turn completes.
     *
     * **When to use this endpoint:** Best for server-to-server integrations, background processing, or any context where you want the full response in one call without managing an SSE stream.
     *
     * **Alternatives:**
     * - `POST /chat/:id/respond` — streaming SSE with normalized events (recommended for custom chat UIs)
     *
     * @param string $id Chat session ID
     * @param array{parts?: list<Part|PartShape>}|ChatSendMessageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function sendMessage(
        string $id,
        array|ChatSendMessageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatSendMessageParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['agent/v1/chat/%1$s/message', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Relays OpenCode SSE events for this chat. Supports replay from buffered events using Last-Event-ID.
     *
     * @param string $id Chat session ID
     * @param array{lastEventID?: int}|ChatStreamParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function stream(
        string $id,
        array|ChatStreamParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatStreamParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['agent/v1/chat/%1$s/stream', $id],
            query: Util::array_transform_keys(
                $parsed,
                ['lastEventID' => 'lastEventId']
            ),
            headers: ['Accept' => 'text/event-stream'],
            options: $options,
            convert: 'string',
        );
    }

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param array{lastEventID?: int}|ChatStreamParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseStream<string>>
     *
     * @throws APIException
     */
    public function streamStream(
        string $id,
        array|ChatStreamParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatStreamParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['agent/v1/chat/%1$s/stream', $id],
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
}
