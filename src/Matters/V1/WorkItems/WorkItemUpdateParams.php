<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\WorkItems;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams\Priority;
use CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams\Status;
use CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams\Type;

/**
 * Update a matter work item.
 *
 * @see CaseDev\Services\Matters\V1\WorkItemsService::update()
 *
 * @phpstan-type WorkItemUpdateParamsShape = array{
 *   id: string,
 *   assigneeID?: string|null,
 *   completedAt?: \DateTimeInterface|null,
 *   description?: string|null,
 *   dueAt?: \DateTimeInterface|null,
 *   exitCriteria?: list<string>|null,
 *   instructions?: string|null,
 *   metadata?: array<string,mixed>|null,
 *   priority?: null|Priority|value-of<Priority>,
 *   startedAt?: \DateTimeInterface|null,
 *   status?: null|Status|value-of<Status>,
 *   title?: string|null,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class WorkItemUpdateParams implements BaseModel
{
    /** @use SdkModel<WorkItemUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    #[Optional('assignee_id', nullable: true)]
    public ?string $assigneeID;

    #[Optional('completed_at', nullable: true)]
    public ?\DateTimeInterface $completedAt;

    #[Optional]
    public ?string $description;

    #[Optional('due_at', nullable: true)]
    public ?\DateTimeInterface $dueAt;

    /** @var list<string>|null $exitCriteria */
    #[Optional('exit_criteria', list: 'string')]
    public ?array $exitCriteria;

    #[Optional(nullable: true)]
    public ?string $instructions;

    /** @var array<string,mixed>|null $metadata */
    #[Optional(map: 'mixed')]
    public ?array $metadata;

    /** @var value-of<Priority>|null $priority */
    #[Optional(enum: Priority::class)]
    public ?string $priority;

    #[Optional('started_at', nullable: true)]
    public ?\DateTimeInterface $startedAt;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    #[Optional]
    public ?string $title;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new WorkItemUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkItemUpdateParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkItemUpdateParams)->withID(...)
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
     * @param Status|value-of<Status>|null $status
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $id,
        ?string $assigneeID = null,
        ?\DateTimeInterface $completedAt = null,
        ?string $description = null,
        ?\DateTimeInterface $dueAt = null,
        ?array $exitCriteria = null,
        ?string $instructions = null,
        ?array $metadata = null,
        Priority|string|null $priority = null,
        ?\DateTimeInterface $startedAt = null,
        Status|string|null $status = null,
        ?string $title = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $assigneeID && $self['assigneeID'] = $assigneeID;
        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $description && $self['description'] = $description;
        null !== $dueAt && $self['dueAt'] = $dueAt;
        null !== $exitCriteria && $self['exitCriteria'] = $exitCriteria;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $priority && $self['priority'] = $priority;
        null !== $startedAt && $self['startedAt'] = $startedAt;
        null !== $status && $self['status'] = $status;
        null !== $title && $self['title'] = $title;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withAssigneeID(?string $assigneeID): self
    {
        $self = clone $this;
        $self['assigneeID'] = $assigneeID;

        return $self;
    }

    public function withCompletedAt(?\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withDueAt(?\DateTimeInterface $dueAt): self
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

    public function withInstructions(?string $instructions): self
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

    public function withStartedAt(?\DateTimeInterface $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

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
