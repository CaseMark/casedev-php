<?php

declare(strict_types=1);

namespace CaseDev\Llm\V1\Chat;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Llm\V1\Chat\ChatCreateCompletionParams\Message;

/**
 * Create a completion for the provided prompt and parameters. Compatible with OpenAI's chat completions API. Supports 40+ models including GPT-4, Claude, Gemini, and CaseMark legal AI models. Includes streaming support, token counting, and usage tracking.
 *
 * @see CaseDev\Services\Llm\V1\ChatService::createCompletion()
 *
 * @phpstan-import-type MessageShape from \CaseDev\Llm\V1\Chat\ChatCreateCompletionParams\Message
 *
 * @phpstan-type ChatCreateCompletionParamsShape = array{
 *   messages: list<Message|MessageShape>,
 *   casemarkShowReasoning?: bool|null,
 *   frequencyPenalty?: float|null,
 *   maxTokens?: int|null,
 *   model?: string|null,
 *   presencePenalty?: float|null,
 *   stream?: bool|null,
 *   temperature?: float|null,
 *   topP?: float|null,
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
     * CaseMark-only: when true, allows reasoning fields in responses. Defaults to false (reasoning is suppressed).
     */
    #[Optional('casemark_show_reasoning')]
    public ?bool $casemarkShowReasoning;

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
     * Model to use for completion. Defaults to casemark/casemark-core-3 if not specified.
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
     * @param list<Message|MessageShape> $messages
     */
    public static function with(
        array $messages,
        ?bool $casemarkShowReasoning = null,
        ?float $frequencyPenalty = null,
        ?int $maxTokens = null,
        ?string $model = null,
        ?float $presencePenalty = null,
        ?bool $stream = null,
        ?float $temperature = null,
        ?float $topP = null,
    ): self {
        $self = new self;

        $self['messages'] = $messages;

        null !== $casemarkShowReasoning && $self['casemarkShowReasoning'] = $casemarkShowReasoning;
        null !== $frequencyPenalty && $self['frequencyPenalty'] = $frequencyPenalty;
        null !== $maxTokens && $self['maxTokens'] = $maxTokens;
        null !== $model && $self['model'] = $model;
        null !== $presencePenalty && $self['presencePenalty'] = $presencePenalty;
        null !== $stream && $self['stream'] = $stream;
        null !== $temperature && $self['temperature'] = $temperature;
        null !== $topP && $self['topP'] = $topP;

        return $self;
    }

    /**
     * List of messages comprising the conversation.
     *
     * @param list<Message|MessageShape> $messages
     */
    public function withMessages(array $messages): self
    {
        $self = clone $this;
        $self['messages'] = $messages;

        return $self;
    }

    /**
     * CaseMark-only: when true, allows reasoning fields in responses. Defaults to false (reasoning is suppressed).
     */
    public function withCasemarkShowReasoning(bool $casemarkShowReasoning): self
    {
        $self = clone $this;
        $self['casemarkShowReasoning'] = $casemarkShowReasoning;

        return $self;
    }

    /**
     * Frequency penalty parameter.
     */
    public function withFrequencyPenalty(float $frequencyPenalty): self
    {
        $self = clone $this;
        $self['frequencyPenalty'] = $frequencyPenalty;

        return $self;
    }

    /**
     * Maximum number of tokens to generate.
     */
    public function withMaxTokens(int $maxTokens): self
    {
        $self = clone $this;
        $self['maxTokens'] = $maxTokens;

        return $self;
    }

    /**
     * Model to use for completion. Defaults to casemark/casemark-core-3 if not specified.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Presence penalty parameter.
     */
    public function withPresencePenalty(float $presencePenalty): self
    {
        $self = clone $this;
        $self['presencePenalty'] = $presencePenalty;

        return $self;
    }

    /**
     * Whether to stream back partial progress.
     */
    public function withStream(bool $stream): self
    {
        $self = clone $this;
        $self['stream'] = $stream;

        return $self;
    }

    /**
     * Sampling temperature between 0 and 2.
     */
    public function withTemperature(float $temperature): self
    {
        $self = clone $this;
        $self['temperature'] = $temperature;

        return $self;
    }

    /**
     * Nucleus sampling parameter.
     */
    public function withTopP(float $topP): self
    {
        $self = clone $this;
        $self['topP'] = $topP;

        return $self;
    }
}
