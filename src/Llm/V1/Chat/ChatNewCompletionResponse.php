<?php

declare(strict_types=1);

namespace CaseDev\Llm\V1\Chat;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Llm\V1\Chat\ChatNewCompletionResponse\Choice;
use CaseDev\Llm\V1\Chat\ChatNewCompletionResponse\Usage;

/**
 * @phpstan-import-type ChoiceShape from \CaseDev\Llm\V1\Chat\ChatNewCompletionResponse\Choice
 * @phpstan-import-type UsageShape from \CaseDev\Llm\V1\Chat\ChatNewCompletionResponse\Usage
 *
 * @phpstan-type ChatNewCompletionResponseShape = array{
 *   id?: string|null,
 *   choices?: list<Choice|ChoiceShape>|null,
 *   created?: int|null,
 *   model?: string|null,
 *   object?: string|null,
 *   usage?: null|Usage|UsageShape,
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
     * @param list<Choice|ChoiceShape>|null $choices
     * @param Usage|UsageShape|null $usage
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
     * @param list<Choice|ChoiceShape> $choices
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
     * @param Usage|UsageShape $usage
     */
    public function withUsage(Usage|array $usage): self
    {
        $self = clone $this;
        $self['usage'] = $usage;

        return $self;
    }
}
