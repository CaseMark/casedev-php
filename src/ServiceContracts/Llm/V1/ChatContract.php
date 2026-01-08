<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Llm\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\Llm\V1\Chat\ChatCreateCompletionParams\Message;
use Casedev\Llm\V1\Chat\ChatNewCompletionResponse;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type MessageShape from \Casedev\Llm\V1\Chat\ChatCreateCompletionParams\Message
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface ChatContract
{
    /**
     * @api
     *
     * @param list<Message|MessageShape> $messages List of messages comprising the conversation
     * @param float $frequencyPenalty Frequency penalty parameter
     * @param int $maxTokens Maximum number of tokens to generate
     * @param string $model Model to use for completion. Defaults to casemark-core-1 if not specified
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
    ): ChatNewCompletionResponse;
}
