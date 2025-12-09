<?php

declare(strict_types=1);

namespace Casedev\Llm\V1\Chat;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
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
 *   frequencyPenalty?: float,
 *   maxTokens?: int,
 *   model?: string,
 *   presencePenalty?: float,
 *   stream?: bool,
 *   temperature?: float,
 *   topP?: float,
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
    #[Required(list: Message::class)]
    public array $messages;

    /**
     * Frequency penalty parameter.
     */
    #[Optional('frequency_penalty')]
    public ?float $frequencyPenalty;

    /**
     * Maximum number of tokens to generate.
     */
    #[Optional('max_tokens')]
    public ?int $maxTokens;

    /**
     * Model to use for completion. Defaults to casemark-core-1 if not specified.
     */
    #[Optional]
    public ?string $model;

    /**
     * Presence penalty parameter.
     */
    #[Optional('presence_penalty')]
    public ?float $presencePenalty;

    /**
     * Whether to stream back partial progress.
     */
    #[Optional]
    public ?bool $stream;

    /**
     * Sampling temperature between 0 and 2.
     */
    #[Optional]
    public ?float $temperature;

    /**
     * Nucleus sampling parameter.
     */
    #[Optional('top_p')]
    public ?float $topP;

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
        ?float $frequencyPenalty = null,
        ?int $maxTokens = null,
        ?string $model = null,
        ?float $presencePenalty = null,
        ?bool $stream = null,
        ?float $temperature = null,
        ?float $topP = null,
    ): self {
        $obj = new self;

        $obj['messages'] = $messages;

        null !== $frequencyPenalty && $obj['frequencyPenalty'] = $frequencyPenalty;
        null !== $maxTokens && $obj['maxTokens'] = $maxTokens;
        null !== $model && $obj['model'] = $model;
        null !== $presencePenalty && $obj['presencePenalty'] = $presencePenalty;
        null !== $stream && $obj['stream'] = $stream;
        null !== $temperature && $obj['temperature'] = $temperature;
        null !== $topP && $obj['topP'] = $topP;

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
        $obj['frequencyPenalty'] = $frequencyPenalty;

        return $obj;
    }

    /**
     * Maximum number of tokens to generate.
     */
    public function withMaxTokens(int $maxTokens): self
    {
        $obj = clone $this;
        $obj['maxTokens'] = $maxTokens;

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
        $obj['presencePenalty'] = $presencePenalty;

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
        $obj['topP'] = $topP;

        return $obj;
    }
}
