<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Agent\V2;

use CaseDev\Agent\V2\Chat\ChatCancelResponse;
use CaseDev\Agent\V2\Chat\ChatDeleteResponse;
use CaseDev\Agent\V2\Chat\ChatNewResponse;
use CaseDev\Agent\V2\Chat\ChatRespondParams\Part;
use CaseDev\Core\Contracts\BaseStream;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type PartShape from \CaseDev\Agent\V2\Chat\ChatRespondParams\Part
 * @phpstan-import-type PartShape from \CaseDev\Agent\V2\Chat\ChatSendMessageParams\Part as PartShape1
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface ChatContract
{
    /**
     * @api
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
    ): ChatNewResponse;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ChatDeleteResponse;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ChatCancelResponse;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param list<Part|PartShape> $parts Message content parts. Currently only "text" type is supported. Additional types (e.g. file, image) may be added in future versions.
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
    ): BaseStream;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param list<\CaseDev\Agent\V2\Chat\ChatSendMessageParams\Part|PartShape1> $parts Message content parts. Currently only "text" type is supported. Additional types (e.g. file, image) may be added in future versions.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function sendMessage(
        string $id,
        ?array $parts = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

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
    ): BaseStream;
}
