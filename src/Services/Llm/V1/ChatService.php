<?php

declare(strict_types=1);

namespace Casedev\Services\Llm\V1;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Llm\V1\Chat\ChatCreateCompletionParams;
use Casedev\Llm\V1\Chat\ChatNewCompletionResponse;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Llm\V1\ChatContract;

final class ChatService implements ChatContract
{
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
     *   messages: list<array{content?: string, role?: 'system'|'user'|'assistant'}>,
     *   frequency_penalty?: float,
     *   max_tokens?: int,
     *   model?: string,
     *   presence_penalty?: float,
     *   stream?: bool,
     *   temperature?: float,
     *   top_p?: float,
     * }|ChatCreateCompletionParams $params
     *
     * @throws APIException
     */
    public function createCompletion(
        array|ChatCreateCompletionParams $params,
        ?RequestOptions $requestOptions = null,
    ): ChatNewCompletionResponse {
        [$parsed, $options] = ChatCreateCompletionParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<ChatNewCompletionResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'llm/v1/chat/completions',
            body: (object) $parsed,
            options: $options,
            convert: ChatNewCompletionResponse::class,
        );

        return $response->parse();
    }
}
