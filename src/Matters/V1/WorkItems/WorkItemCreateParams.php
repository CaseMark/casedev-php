<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\WorkItems;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Matters\V1\WorkItems\WorkItemCreateParams\Priority;
use CaseDev\Matters\V1\WorkItems\WorkItemCreateParams\Type;

/**
 * Create an active work item on a matter.
 *
 * @see CaseDev\Services\Matters\V1\WorkItemsService::create()
 *
 * @phpstan-type WorkItemCreateParamsShape = array{
 *   title: string,
 *   assigneeID?: string|null,
 *   description?: string|null,
 *   dueAt?: \DateTimeInterface|null,
 *   exitCriteria?: list<string>|null,
 *   instructions?: string|null,
 *   metadata?: array<string,mixed>|null,
 *   priority?: null|Priority|value-of<Priority>,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class WorkItemCreateParams implements BaseModel
{
    /** @use SdkModel<WorkItemCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $title;

    #[Optional('assignee_id')]
    public ?string $assigneeID;

    #[Optional]
    public ?string $description;

    #[Optional('due_at')]
    public ?\DateTimeInterface $dueAt;

    /** @var list<string>|null $exitCriteria */
    #[Optional('exit_criteria', list: 'string')]
    public ?array $exitCriteria;

    #[Optional]
    public ?string $instructions;

    /** @var array<string,mixed>|null $metadata */
    #[Optional(map: 'mixed')]
    public ?array $metadata;

    /** @var value-of<Priority>|null $priority */
    #[Optional(enum: Priority::class)]
    public ?string $priority;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new WorkItemCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkItemCreateParams::with(title: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkItemCreateParams)->withTitle(...)
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
     * @param list<string>|null $exitCriteria
     * @param array<string,mixed>|null $metadata
     * @param Priority|value-of<Priority>|null $priority
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $title,
        ?string $assigneeID = null,
        ?string $description = null,
        ?\DateTimeInterface $dueAt = null,
        ?array $exitCriteria = null,
        ?string $instructions = null,
        ?array $metadata = null,
        Priority|string|null $priority = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        $self['title'] = $title;

        null !== $assigneeID && $self['assigneeID'] = $assigneeID;
        null !== $description && $self['description'] = $description;
        null !== $dueAt && $self['dueAt'] = $dueAt;
        null !== $exitCriteria && $self['exitCriteria'] = $exitCriteria;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $priority && $self['priority'] = $priority;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    public function withAssigneeID(string $assigneeID): self
    {
        $self = clone $this;
        $self['assigneeID'] = $assigneeID;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withDueAt(\DateTimeInterface $dueAt): self
    {
        $self = clone $this;
        $self['dueAt'] = $dueAt;

        return $self;
    }

    /**
     * @param list<string> $exitCriteria
     */
    public function withExitCriteria(array $exitCriteria): self
    {
        $self = clone $this;
        $self['exitCriteria'] = $exitCriteria;

        return $self;
    }

    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * @param array<string,mixed> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * @param Priority|value-of<Priority> $priority
     */
    public function withPriority(Priority|string $priority): self
    {
        $self = clone $this;
        $self['priority'] = $priority;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
