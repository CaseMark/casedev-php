<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent\V2;

use CaseDev\Agent\V2\Chat\ChatCancelResponse;
use CaseDev\Agent\V2\Chat\ChatDeleteResponse;
use CaseDev\Agent\V2\Chat\ChatNewResponse;
use CaseDev\Agent\V2\Chat\ChatNewStreamTokenResponse;
use CaseDev\Agent\V2\Chat\ChatRespondParams\Part;
use CaseDev\Client;
use CaseDev\Core\Contracts\BaseStream;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Agent\V2\ChatContract;
use CaseDev\Services\Agent\V2\Chat\FilesService;

/**
 * Create, manage, and execute AI agents with tool access, sandbox environments, and async run workflows.
 *
 * @phpstan-import-type PartShape from \CaseDev\Agent\V2\Chat\ChatRespondParams\Part
 * @phpstan-import-type PartShape from \CaseDev\Agent\V2\Chat\ChatSendMessageParams\Part as PartShape1
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class ChatService implements ChatContract
{
    /**
     * @api
     */
    public ChatRawService $raw;

    /**
     * @api
     */
    public FilesService $files;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ChatRawService($client);
        $this->files = new FilesService($client);
    }

    /**
     * @api
     *
     * Creates a persistent OpenCode chat session backed by a Daytona runtime. Session state is retained and can be resumed or recovered across requests.
     *
     * @param int|null $idleTimeoutMs Idle timeout before the runtime is eligible to stop. Defaults to 15 minutes.
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
     * Terminates the active Daytona runtime (if any), then marks the chat as ended.
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
     * Aborts the active OpenCode generation for this Daytona-backed chat session.
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
     * Returns a short-lived token that allows browser clients to connect directly to the agent chat SSE stream without exposing the underlying org API key.
     *
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createStreamToken(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ChatNewStreamTokenResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createStreamToken($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Answers a pending OpenCode question for the Daytona-backed chat session and resumes or recovers the runtime if needed.
     *
     * @param string $requestID Path param: Pending question request ID
     * @param string $id Path param: Chat session ID
     * @param list<list<string>> $answers Body param: Answer selections for each prompt element in the pending question
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
     * @param string $id Chat session ID
     * @param string|null $model Optional model override. When provided, the runtime bootstrap config is updated so subsequent turns use this model. Conversation history is preserved.
     * @param list<Part|PartShape> $parts Message content parts. Currently only "text" type is supported. Additional types (e.g. file, image) may be added in future versions.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseStream<string>
     *
     * @throws APIException
     */
    public function respondStream(
        string $id,
        ?string $model = null,
        ?array $parts = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream {
        $params = Util::removeNulls(['model' => $model, 'parts' => $parts]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->respondStream($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Sends a message to a Daytona-backed chat runtime and returns the complete response as a single JSON body. Blocks until the assistant turn completes.
     *
     * **When to use this endpoint:** Best for server-to-server integrations, background processing, or any context where you want the full response in one call without managing an SSE stream.
     *
     * **Alternatives:**
     * - `POST /chat/:id/respond` — streaming SSE with normalized events (recommended for custom chat UIs)
     *
     * @param string $id Chat session ID
     * @param string|null $model Optional model override. When provided, the runtime bootstrap config is updated so subsequent turns use this model. Conversation history is preserved.
     * @param list<\CaseDev\Agent\V2\Chat\ChatSendMessageParams\Part|PartShape1> $parts Message content parts. Currently only "text" type is supported. Additional types (e.g. file, image) may be added in future versions.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function sendMessage(
        string $id,
        ?string $model = null,
        ?array $parts = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['model' => $model, 'parts' => $parts]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->sendMessage($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param string $token Short-lived stream token from POST /agent/v2/chat/:id/stream-token. If provided, Bearer auth is not required.
     * @param int $lastEventID Replay events after this sequence number
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseStream<string>
     *
     * @throws APIException
     */
    public function streamStream(
        string $id,
        ?string $token = null,
        ?int $lastEventID = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream {
        $params = Util::removeNulls(
            ['token' => $token, 'lastEventID' => $lastEventID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->streamStream($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
