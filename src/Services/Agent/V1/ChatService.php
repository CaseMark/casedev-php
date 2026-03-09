<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent\V1;

use CaseDev\Agent\V1\Chat\ChatCancelResponse;
use CaseDev\Agent\V1\Chat\ChatDeleteResponse;
use CaseDev\Agent\V1\Chat\ChatNewResponse;
use CaseDev\Client;
use CaseDev\Core\Contracts\BaseStream;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Agent\V1\ChatContract;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class ChatService implements ChatContract
{
    /**
     * @api
     */
    public ChatRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ChatRawService($client);
    }

    /**
     * @api
     *
     * Creates a persistent OpenCode chat session in a Modal sandbox. Session state is retained and can be resumed across requests.
     *
     * @param int|null $idleTimeoutMs Idle timeout before session is eligible for snapshot/termination. Defaults to 15 minutes.
     * @param string|null $model Optional model override for the OpenCode session
     * @param string $title Optional human-readable session title
     * @param list<string>|null $vaultIDs Restrict the chat session to specific vault IDs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?int $idleTimeoutMs = null,
        ?string $model = null,
        ?string $title = null,
        ?array $vaultIDs = null,
        RequestOptions|array|null $requestOptions = null,
    ): ChatNewResponse {
        $params = Util::removeNulls(
            [
                'idleTimeoutMs' => $idleTimeoutMs,
                'model' => $model,
                'title' => $title,
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
     * Snapshots and terminates the active sandbox (if any), then marks the chat as ended.
     *
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ChatDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Aborts the active OpenCode generation for this chat session.
     *
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ChatCancelResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Answers a pending OpenCode question for the chat session bound to this agent chat.
     *
     * @param string $requestID Path param: Pending question request ID
     * @param string $id Path param: Chat session ID
     * @param list<list<string>> $answers Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function replyToQuestion(
        string $requestID,
        string $id,
        array $answers,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['id' => $id, 'answers' => $answers]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->replyToQuestion($requestID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Streams a single assistant turn as normalized state events with stable turn, message, and part ids. Emits session.usage before turn.completed when token data is available.
     *
     * @param string $id Chat session ID
     * @param mixed $body OpenCode message payload. Passed through 1:1.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function respond(
        string $id,
        mixed $body,
        RequestOptions|array|null $requestOptions = null
    ): string {
        $params = Util::removeNulls(['body' => $body]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->respond($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param mixed $body OpenCode message payload. Passed through 1:1.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseStream<string>
     *
     * @throws APIException
     */
    public function respondStream(
        string $id,
        mixed $body,
        RequestOptions|array|null $requestOptions = null
    ): BaseStream {
        $params = Util::removeNulls(['body' => $body]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->respondStream($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Proxies a message to the OpenCode session bound to this chat.
     *
     * @param string $id Chat session ID
     * @param mixed $body OpenCode message payload. Passed through 1:1.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function sendMessage(
        string $id,
        mixed $body,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        $params = Util::removeNulls(['body' => $body]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->sendMessage($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Relays OpenCode SSE events for this chat. Supports replay from buffered events using Last-Event-ID.
     *
     * @param string $id Chat session ID
     * @param int $lastEventID Replay events after this sequence number
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function stream(
        string $id,
        ?int $lastEventID = null,
        RequestOptions|array|null $requestOptions = null,
    ): string {
        $params = Util::removeNulls(['lastEventID' => $lastEventID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->stream($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param int $lastEventID Replay events after this sequence number
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseStream<string>
     *
     * @throws APIException
     */
    public function streamStream(
        string $id,
        ?int $lastEventID = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream {
        $params = Util::removeNulls(['lastEventID' => $lastEventID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->streamStream($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Streams a single assistant turn as AI SDK UIMessageChunk SSE events for direct client rendering.
     *
     * @param string $id Chat session ID
     * @param mixed $body OpenCode message payload. Passed through 1:1.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function uiStream(
        string $id,
        mixed $body,
        RequestOptions|array|null $requestOptions = null
    ): string {
        $params = Util::removeNulls(['body' => $body]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->uiStream($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param mixed $body OpenCode message payload. Passed through 1:1.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseStream<string>
     *
     * @throws APIException
     */
    public function uiStreamStream(
        string $id,
        mixed $body,
        RequestOptions|array|null $requestOptions = null
    ): BaseStream {
        $params = Util::removeNulls(['body' => $body]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->uiStreamStream($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
