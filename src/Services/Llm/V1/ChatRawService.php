<?php

declare(strict_types=1);

namespace CaseDev\Services\Llm\V1;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Llm\V1\Chat\ChatCreateCompletionParams;
use CaseDev\Llm\V1\Chat\ChatCreateCompletionParams\Message;
use CaseDev\Llm\V1\Chat\ChatNewCompletionResponse;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Llm\V1\ChatRawContract;

/**
 * @phpstan-import-type MessageShape from \CaseDev\Llm\V1\Chat\ChatCreateCompletionParams\Message
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
     * Create a completion for the provided prompt and parameters. Compatible with OpenAI's chat completions API. Supports 40+ models including GPT-4, Claude, Gemini, and CaseMark legal AI models. Includes streaming support, token counting, and usage tracking.
     *
     * @param array{
     *   messages: list<Message|MessageShape>,
     *   casemarkShowReasoning?: bool,
     *   frequencyPenalty?: float,
     *   maxTokens?: int,
     *   model?: string,
     *   presencePenalty?: float,
     *   stream?: bool,
     *   temperature?: float,
     *   topP?: float,
     * }|ChatCreateCompletionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ChatNewCompletionResponse>
     *
     * @throws APIException
     */
    public function createCompletion(
        array|ChatCreateCompletionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ChatCreateCompletionParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'llm/v1/chat/completions',
            body: (object) $parsed,
            options: $options,
            convert: ChatNewCompletionResponse::class,
        );
    }
}
