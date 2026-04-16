<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run;

use CaseDev\Agent\V1\Run\RunGetDetailsResponse\Provider;
use CaseDev\Agent\V1\Run\RunGetDetailsResponse\Result;
use CaseDev\Agent\V1\Run\RunGetDetailsResponse\RuntimeState;
use CaseDev\Agent\V1\Run\RunGetDetailsResponse\Status;
use CaseDev\Agent\V1\Run\RunGetDetailsResponse\Step;
use CaseDev\Agent\V1\Run\RunGetDetailsResponse\Usage;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ResultShape from \CaseDev\Agent\V1\Run\RunGetDetailsResponse\Result
 * @phpstan-import-type StepShape from \CaseDev\Agent\V1\Run\RunGetDetailsResponse\Step
 * @phpstan-import-type UsageShape from \CaseDev\Agent\V1\Run\RunGetDetailsResponse\Usage
 *
 * @phpstan-type RunGetDetailsResponseShape = array{
 *   id?: string|null,
 *   agentID?: string|null,
 *   completedAt?: \DateTimeInterface|null,
 *   createdAt?: \DateTimeInterface|null,
 *   guidance?: string|null,
 *   modalSandboxID?: string|null,
 *   model?: string|null,
 *   prompt?: string|null,
 *   provider?: null|Provider|value-of<Provider>,
 *   result?: null|Result|ResultShape,
 *   runtimeID?: string|null,
 *   runtimeState?: null|RuntimeState|value-of<RuntimeState>,
 *   startedAt?: \DateTimeInterface|null,
 *   status?: null|Status|value-of<Status>,
 *   steps?: list<Step|StepShape>|null,
 *   usage?: null|Usage|UsageShape,
 *   workflowID?: string|null,
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

    /**
     * @deprecated
     *
     * Deprecated legacy Modal sandbox ID. Prefer `provider` and `runtimeId`.
     */
    #[Optional('modalSandboxId', nullable: true)]
    public ?string $modalSandboxID;

    #[Optional(nullable: true)]
    public ?string $model;

    #[Optional]
    public ?string $prompt;

    /**
     * Runtime provider for this run.
     *
     * @var value-of<Provider>|null $provider
     */
    #[Optional(enum: Provider::class, nullable: true)]
    public ?string $provider;

    /**
     * Final output from the agent.
     */
    #[Optional(nullable: true)]
    public ?Result $result;

    /**
     * Provider-specific runtime identifier.
     */
    #[Optional('runtimeId', nullable: true)]
    public ?string $runtimeID;

    /**
     * Current runtime state, when available.
     *
     * @var value-of<RuntimeState>|null $runtimeState
     */
    #[Optional(enum: RuntimeState::class, nullable: true)]
    public ?string $runtimeState;

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

    /**
     * Durable workflow run ID.
     */
    #[Optional('workflowId', nullable: true)]
    public ?string $workflowID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Provider|value-of<Provider>|null $provider
     * @param Result|ResultShape|null $result
     * @param RuntimeState|value-of<RuntimeState>|null $runtimeState
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
        ?string $modalSandboxID = null,
        ?string $model = null,
        ?string $prompt = null,
        Provider|string|null $provider = null,
        Result|array|null $result = null,
        ?string $runtimeID = null,
        RuntimeState|string|null $runtimeState = null,
        ?\DateTimeInterface $startedAt = null,
        Status|string|null $status = null,
        ?array $steps = null,
        Usage|array|null $usage = null,
        ?string $workflowID = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $agentID && $self['agentID'] = $agentID;
        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $guidance && $self['guidance'] = $guidance;
        null !== $modalSandboxID && $self['modalSandboxID'] = $modalSandboxID;
        null !== $model && $self['model'] = $model;
        null !== $prompt && $self['prompt'] = $prompt;
        null !== $provider && $self['provider'] = $provider;
        null !== $result && $self['result'] = $result;
        null !== $runtimeID && $self['runtimeID'] = $runtimeID;
        null !== $runtimeState && $self['runtimeState'] = $runtimeState;
        null !== $startedAt && $self['startedAt'] = $startedAt;
        null !== $status && $self['status'] = $status;
        null !== $steps && $self['steps'] = $steps;
        null !== $usage && $self['usage'] = $usage;
        null !== $workflowID && $self['workflowID'] = $workflowID;

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

    /**
     * Deprecated legacy Modal sandbox ID. Prefer `provider` and `runtimeId`.
     */
    public function withModalSandboxID(?string $modalSandboxID): self
    {
        $self = clone $this;
        $self['modalSandboxID'] = $modalSandboxID;

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
     * Runtime provider for this run.
     *
     * @param Provider|value-of<Provider>|null $provider
     */
    public function withProvider(Provider|string|null $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

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

    /**
     * Provider-specific runtime identifier.
     */
    public function withRuntimeID(?string $runtimeID): self
    {
        $self = clone $this;
        $self['runtimeID'] = $runtimeID;

        return $self;
    }

    /**
     * Current runtime state, when available.
     *
     * @param RuntimeState|value-of<RuntimeState>|null $runtimeState
     */
    public function withRuntimeState(
        RuntimeState|string|null $runtimeState
    ): self {
        $self = clone $this;
        $self['runtimeState'] = $runtimeState;

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

    /**
     * Durable workflow run ID.
     */
    public function withWorkflowID(?string $workflowID): self
    {
        $self = clone $this;
        $self['workflowID'] = $workflowID;

        return $self;
    }
}
