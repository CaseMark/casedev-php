<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\WorkItems;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Matters\V1\WorkItems\WorkItemDecideParams\Decision;

/**
 * Allow a human to act as the orchestrator for a work item.
 *
 * @see CaseDev\Services\Matters\V1\WorkItemsService::decide()
 *
 * @phpstan-type WorkItemDecideParamsShape = array{
 *   id: string,
 *   decision: Decision|value-of<Decision>,
 *   agentTypeID?: string|null,
 *   metadata?: array<string,mixed>|null,
 *   reason?: string|null,
 * }
 */
final class WorkItemDecideParams implements BaseModel
{
    /** @use SdkModel<WorkItemDecideParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /** @var value-of<Decision> $decision */
    #[Required(enum: Decision::class)]
    public string $decision;

    #[Optional('agent_type_id', nullable: true)]
    public ?string $agentTypeID;

    /** @var array<string,mixed>|null $metadata */
    #[Optional(map: 'mixed')]
    public ?array $metadata;

    #[Optional(nullable: true)]
    public ?string $reason;

    /**
     * `new WorkItemDecideParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkItemDecideParams::with(id: ..., decision: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkItemDecideParams)->withID(...)->withDecision(...)
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
     * @param Decision|value-of<Decision> $decision
     * @param array<string,mixed>|null $metadata
     */
    public static function with(
        string $id,
        Decision|string $decision,
        ?string $agentTypeID = null,
        ?array $metadata = null,
        ?string $reason = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['decision'] = $decision;

        null !== $agentTypeID && $self['agentTypeID'] = $agentTypeID;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * @param Decision|value-of<Decision> $decision
     */
    public function withDecision(Decision|string $decision): self
    {
        $self = clone $this;
        $self['decision'] = $decision;

        return $self;
    }

    public function withAgentTypeID(?string $agentTypeID): self
    {
        $self = clone $this;
        $self['agentTypeID'] = $agentTypeID;

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

    public function withReason(?string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
