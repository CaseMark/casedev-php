<?php

declare(strict_types=1);

namespace Casedev\Llm\V1\Chat;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Llm\V1\Chat\ChatCreateCompletionParams\Message;
use Casedev\Llm\V1\Chat\ChatCreateCompletionParams\Message\Role;

/**
 * Create a completion for the provided prompt and parameters. Compatible with OpenAI's chat completions API. Supports 40+ models including GPT-4, Claude, Gemini, and CaseMark legal AI models. Includes streaming support, token counting, and usage tracking.
 *
 * @see Casedev\Services\Llm\V1\ChatService::createCompletion()
 *
 * @phpstan-type ChatCreateCompletionParamsShape = array{
 *   messages: list<Message|array{
 *     content?: string|null, role?: value-of<Role>|null
 *   }>,
 *   frequency_penalty?: float,
 *   max_tokens?: int,
 *   model?: string,
 *   presence_penalty?: float,
 *   stream?: bool,
 *   temperature?: float,
 *   top_p?: float,
 * }
 */
final class ChatCreateCompletionParams implements BaseModel
{
    /** @use SdkModel<ChatCreateCompletionParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * List of messages comprising the conversation.
     *
     * @var list<Message> $messages
     */
    #[Api(list: Message::class)]
    public array $messages;

    /**
     * Frequency penalty parameter.
     */
    #[Api(optional: true)]
    public ?float $frequency_penalty;

    /**
     * Maximum number of tokens to generate.
     */
    #[Api(optional: true)]
    public ?int $max_tokens;

    /**
     * Model to use for completion. Defaults to casemark-core-1 if not specified.
     */
    #[Api(optional: true)]
    public ?string $model;

    /**
     * Presence penalty parameter.
     */
    #[Api(optional: true)]
    public ?float $presence_penalty;

    /**
     * Whether to stream back partial progress.
     */
    #[Api(optional: true)]
    public ?bool $stream;

    /**
     * Sampling temperature between 0 and 2.
     */
    #[Api(optional: true)]
    public ?float $temperature;

    /**
     * Nucleus sampling parameter.
     */
    #[Api(optional: true)]
    public ?float $top_p;

    /**
     * `new ChatCreateCompletionParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChatCreateCompletionParams::with(messages: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChatCreateCompletionParams)->withMessages(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Message|array{
     *   content?: string|null, role?: value-of<Role>|null
     * }> $messages
     */
    public static function with(
        array $messages,
        ?float $frequency_penalty = null,
        ?int $max_tokens = null,
        ?string $model = null,
        ?float $presence_penalty = null,
        ?bool $stream = null,
        ?float $temperature = null,
        ?float $top_p = null,
    ): self {
        $obj = new self;

        $obj['messages'] = $messages;

        null !== $frequency_penalty && $obj['frequency_penalty'] = $frequency_penalty;
        null !== $max_tokens && $obj['max_tokens'] = $max_tokens;
        null !== $model && $obj['model'] = $model;
        null !== $presence_penalty && $obj['presence_penalty'] = $presence_penalty;
        null !== $stream && $obj['stream'] = $stream;
        null !== $temperature && $obj['temperature'] = $temperature;
        null !== $top_p && $obj['top_p'] = $top_p;

        return $obj;
    }

    /**
     * List of messages comprising the conversation.
     *
     * @param list<Message|array{
     *   content?: string|null, role?: value-of<Role>|null
     * }> $messages
     */
    public function withMessages(array $messages): self
    {
        $obj = clone $this;
        $obj['messages'] = $messages;

        return $obj;
    }

    /**
     * Frequency penalty parameter.
     */
    public function withFrequencyPenalty(float $frequencyPenalty): self
    {
        $obj = clone $this;
        $obj['frequency_penalty'] = $frequencyPenalty;

        return $obj;
    }

    /**
     * Maximum number of tokens to generate.
     */
    public function withMaxTokens(int $maxTokens): self
    {
        $obj = clone $this;
        $obj['max_tokens'] = $maxTokens;

        return $obj;
    }

    /**
     * Model to use for completion. Defaults to casemark-core-1 if not specified.
     */
    public function withModel(string $model): self
    {
        $obj = clone $this;
        $obj['model'] = $model;

        return $obj;
    }

    /**
     * Presence penalty parameter.
     */
    public function withPresencePenalty(float $presencePenalty): self
    {
        $obj = clone $this;
        $obj['presence_penalty'] = $presencePenalty;

        return $obj;
    }

    /**
     * Whether to stream back partial progress.
     */
    public function withStream(bool $stream): self
    {
        $obj = clone $this;
        $obj['stream'] = $stream;

        return $obj;
    }

    /**
     * Sampling temperature between 0 and 2.
     */
    public function withTemperature(float $temperature): self
    {
        $obj = clone $this;
        $obj['temperature'] = $temperature;

        return $obj;
    }

    /**
     * Nucleus sampling parameter.
     */
    public function withTopP(float $topP): self
    {
        $obj = clone $this;
        $obj['top_p'] = $topP;

        return $obj;
    }
}
