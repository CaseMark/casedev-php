<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent\V1;

use CaseDev\Agent\V1\Chat\ChatCancelResponse;
use CaseDev\Agent\V1\Chat\ChatDeleteResponse;
use CaseDev\Agent\V1\Chat\ChatNewResponse;
use CaseDev\Agent\V1\Chat\ChatSendMessageParams\Part;
use CaseDev\Client;
use CaseDev\Core\Contracts\BaseStream;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Agent\V1\ChatContract;

/**
 * Create, manage, and execute AI agents with tool access, sandbox environments, and async run workflows.
 *
 * @phpstan-import-type PartShape from \CaseDev\Agent\V1\Chat\ChatSendMessageParams\Part
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 * @phpstan-import-type PartShape from \CaseDev\Agent\V1\Chat\ChatRespondParams\Part as PartShape1
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
     * Streams a single assistant turn as normalized SSE events with stable turn, message, and part IDs. Emits events: `turn.started`, `turn.status`, `message.created`, `message.part.updated`, `message.completed`, `session.usage`, `turn.completed`.
     *
     * **When to use this endpoint:** Recommended for building custom chat UIs that need real-time streaming progress. This is the primary streaming endpoint for new integrations.
     *
     * **Alternatives:**
     * - `POST /chat/:id/message` — synchronous, returns complete response as JSON (best for server-to-server)
     *
     * @param string $id Chat session ID
     * @param list<\CaseDev\Agent\V1\Chat\ChatRespondParams\Part|PartShape1> $parts Message content parts. Currently only "text" type is supported. Additional types (e.g. file, image) may be added in future versions.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function respond(
        string $id,
        ?array $parts = null,
        RequestOptions|array|null $requestOptions = null,
    ): string {
        $params = Util::removeNulls(['parts' => $parts]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->respond($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param list<\CaseDev\Agent\V1\Chat\ChatRespondParams\Part|PartShape1> $parts Message content parts. Currently only "text" type is supported. Additional types (e.g. file, image) may be added in future versions.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseStream<string>
     *
     * @throws APIException
     */
    public function respondStream(
        string $id,
        ?array $parts = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream {
        $params = Util::removeNulls(['parts' => $parts]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->respondStream($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param list<Part|PartShape> $parts Message content parts. Currently only "text" type is supported. Additional types (e.g. file, image) may be added in future versions.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function sendMessage(
        string $id,
        ?array $parts = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['parts' => $parts]);

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
}
