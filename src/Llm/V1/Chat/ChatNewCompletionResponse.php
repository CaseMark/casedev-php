<?php

declare(strict_types=1);

namespace Casedev\Llm\V1\Chat;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Llm\V1\Chat\ChatNewCompletionResponse\Choice;
use Casedev\Llm\V1\Chat\ChatNewCompletionResponse\Choice\Message;
use Casedev\Llm\V1\Chat\ChatNewCompletionResponse\Usage;

/**
 * @phpstan-type ChatNewCompletionResponseShape = array{
 *   id?: string|null,
 *   choices?: list<Choice>|null,
 *   created?: int|null,
 *   model?: string|null,
 *   object?: string|null,
 *   usage?: Usage|null,
 * }
 */
final class ChatNewCompletionResponse implements BaseModel
{
    /** @use SdkModel<ChatNewCompletionResponseShape> */
    use SdkModel;

    /**
     * Unique identifier for the completion.
     */
    #[Optional]
    public ?string $id;

    /** @var list<Choice>|null $choices */
    #[Optional(list: Choice::class)]
    public ?array $choices;

    /**
     * Unix timestamp of completion creation.
     */
    #[Optional]
    public ?int $created;

    /**
     * Model used for completion.
     */
    #[Optional]
    public ?string $model;

    #[Optional]
    public ?string $object;

    #[Optional]
    public ?Usage $usage;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Choice|array{
     *   finishReason?: string|null, index?: int|null, message?: Message|null
     * }> $choices
     * @param Usage|array{
     *   completionTokens?: int|null,
     *   cost?: float|null,
     *   promptTokens?: int|null,
     *   totalTokens?: int|null,
     * } $usage
     */
    public static function with(
        ?string $id = null,
        ?array $choices = null,
        ?int $created = null,
        ?string $model = null,
        ?string $object = null,
        Usage|array|null $usage = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $choices && $self['choices'] = $choices;
        null !== $created && $self['created'] = $created;
        null !== $model && $self['model'] = $model;
        null !== $object && $self['object'] = $object;
        null !== $usage && $self['usage'] = $usage;

        return $self;
    }

    /**
     * Unique identifier for the completion.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * @param list<Choice|array{
     *   finishReason?: string|null, index?: int|null, message?: Message|null
     * }> $choices
     */
    public function withChoices(array $choices): self
    {
        $self = clone $this;
        $self['choices'] = $choices;

        return $self;
    }

    /**
     * Unix timestamp of completion creation.
     */
    public function withCreated(int $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * Model used for completion.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    public function withObject(string $object): self
    {
        $self = clone $this;
        $self['object'] = $object;

        return $self;
    }

    /**
     * @param Usage|array{
     *   completionTokens?: int|null,
     *   cost?: float|null,
     *   promptTokens?: int|null,
     *   totalTokens?: int|null,
     * } $usage
     */
    public function withUsage(Usage|array $usage): self
    {
        $self = clone $this;
        $self['usage'] = $usage;

        return $self;
    }
}
