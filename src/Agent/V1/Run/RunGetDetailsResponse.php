<?php

declare(strict_types=1);

namespace Router\Agent\V1\Run;

use Router\Agent\V1\Run\RunGetDetailsResponse\Result;
use Router\Agent\V1\Run\RunGetDetailsResponse\Status;
use Router\Agent\V1\Run\RunGetDetailsResponse\Step;
use Router\Agent\V1\Run\RunGetDetailsResponse\Usage;
use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ResultShape from \Router\Agent\V1\Run\RunGetDetailsResponse\Result
 * @phpstan-import-type StepShape from \Router\Agent\V1\Run\RunGetDetailsResponse\Step
 * @phpstan-import-type UsageShape from \Router\Agent\V1\Run\RunGetDetailsResponse\Usage
 *
 * @phpstan-type RunGetDetailsResponseShape = array{
 *   id?: string|null,
 *   agentID?: string|null,
 *   completedAt?: \DateTimeInterface|null,
 *   createdAt?: \DateTimeInterface|null,
 *   guidance?: string|null,
 *   model?: string|null,
 *   prompt?: string|null,
 *   result?: null|Result|ResultShape,
 *   startedAt?: \DateTimeInterface|null,
 *   status?: null|Status|value-of<Status>,
 *   steps?: list<Step|StepShape>|null,
 *   usage?: null|Usage|UsageShape,
 * }
 */
final class RunGetDetailsResponse implements BaseModel
{
    /** @use SdkModel<RunGetDetailsResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional('agentId')]
    public ?string $agentID;

    #[Optional(nullable: true)]
    public ?\DateTimeInterface $completedAt;

    #[Optional]
    public ?\DateTimeInterface $createdAt;

    #[Optional(nullable: true)]
    public ?string $guidance;

    #[Optional(nullable: true)]
    public ?string $model;

    #[Optional]
    public ?string $prompt;

    /**
     * Final output from the agent.
     */
    #[Optional(nullable: true)]
    public ?Result $result;

    #[Optional(nullable: true)]
    public ?\DateTimeInterface $startedAt;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /** @var list<Step>|null $steps */
    #[Optional(list: Step::class)]
    public ?array $steps;

    /**
     * Token usage statistics.
     */
    #[Optional(nullable: true)]
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
     * @param Result|ResultShape|null $result
     * @param Status|value-of<Status>|null $status
     * @param list<Step|StepShape>|null $steps
     * @param Usage|UsageShape|null $usage
     */
    public static function with(
        ?string $id = null,
        ?string $agentID = null,
        ?\DateTimeInterface $completedAt = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $guidance = null,
        ?string $model = null,
        ?string $prompt = null,
        Result|array|null $result = null,
        ?\DateTimeInterface $startedAt = null,
        Status|string|null $status = null,
        ?array $steps = null,
        Usage|array|null $usage = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $agentID && $self['agentID'] = $agentID;
        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $guidance && $self['guidance'] = $guidance;
        null !== $model && $self['model'] = $model;
        null !== $prompt && $self['prompt'] = $prompt;
        null !== $result && $self['result'] = $result;
        null !== $startedAt && $self['startedAt'] = $startedAt;
        null !== $status && $self['status'] = $status;
        null !== $steps && $self['steps'] = $steps;
        null !== $usage && $self['usage'] = $usage;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withAgentID(string $agentID): self
    {
        $self = clone $this;
        $self['agentID'] = $agentID;

        return $self;
    }

    public function withCompletedAt(?\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withGuidance(?string $guidance): self
    {
        $self = clone $this;
        $self['guidance'] = $guidance;

        return $self;
    }

    public function withModel(?string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    public function withPrompt(string $prompt): self
    {
        $self = clone $this;
        $self['prompt'] = $prompt;

        return $self;
    }

    /**
     * Final output from the agent.
     *
     * @param Result|ResultShape|null $result
     */
    public function withResult(Result|array|null $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

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

    /**
     * @param list<Step|StepShape> $steps
     */
    public function withSteps(array $steps): self
    {
        $self = clone $this;
        $self['steps'] = $steps;

        return $self;
    }

    /**
     * Token usage statistics.
     *
     * @param Usage|UsageShape|null $usage
     */
    public function withUsage(Usage|array|null $usage): self
    {
        $self = clone $this;
        $self['usage'] = $usage;

        return $self;
    }
}
