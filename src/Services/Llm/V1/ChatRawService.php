<?php

declare(strict_types=1);

namespace Router\Services\Llm\V1;

use Router\Client;
use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\Llm\V1\Chat\ChatCreateCompletionParams;
use Router\Llm\V1\Chat\ChatCreateCompletionParams\Message;
use Router\Llm\V1\Chat\ChatNewCompletionResponse;
use Router\RequestOptions;
use Router\ServiceContracts\Llm\V1\ChatRawContract;

/**
 * @phpstan-import-type MessageShape from \Router\Llm\V1\Chat\ChatCreateCompletionParams\Message
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
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
