<?php

declare(strict_types=1);

namespace Casedev\Services\Llm\V1;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Llm\V1\Chat\ChatCreateCompletionParams\Message;
use Casedev\Llm\V1\Chat\ChatNewCompletionResponse;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Llm\V1\ChatContract;

/**
 * @phpstan-import-type MessageShape from \Casedev\Llm\V1\Chat\ChatCreateCompletionParams\Message
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
     * Create a completion for the provided prompt and parameters. Compatible with OpenAI's chat completions API. Supports 40+ models including GPT-4, Claude, Gemini, and CaseMark legal AI models. Includes streaming support, token counting, and usage tracking.
     *
     * @param list<Message|MessageShape> $messages List of messages comprising the conversation
     * @param float $frequencyPenalty Frequency penalty parameter
     * @param int $maxTokens Maximum number of tokens to generate
     * @param string $model Model to use for completion. Defaults to casemark/casemark-core-3 if not specified
     * @param float $presencePenalty Presence penalty parameter
     * @param bool $stream Whether to stream back partial progress
     * @param float $temperature Sampling temperature between 0 and 2
     * @param float $topP Nucleus sampling parameter
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createCompletion(
        array $messages,
        ?float $frequencyPenalty = null,
        ?int $maxTokens = null,
        ?string $model = null,
        ?float $presencePenalty = null,
        ?bool $stream = null,
        ?float $temperature = null,
        ?float $topP = null,
        RequestOptions|array|null $requestOptions = null,
    ): ChatNewCompletionResponse {
        $params = Util::removeNulls(
            [
                'messages' => $messages,
                'frequencyPenalty' => $frequencyPenalty,
                'maxTokens' => $maxTokens,
                'model' => $model,
                'presencePenalty' => $presencePenalty,
                'stream' => $stream,
                'temperature' => $temperature,
                'topP' => $topP,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createCompletion(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
