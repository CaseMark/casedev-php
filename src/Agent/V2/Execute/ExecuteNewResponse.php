<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Execute;

use CaseDev\Agent\V2\Execute\ExecuteNewResponse\Provider;
use CaseDev\Agent\V2\Execute\ExecuteNewResponse\RuntimeState;
use CaseDev\Agent\V2\Execute\ExecuteNewResponse\Status;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ExecuteNewResponseShape = array{
 *   agentID?: string|null,
 *   message?: string|null,
 *   provider?: null|Provider|value-of<Provider>,
 *   runID?: string|null,
 *   runtimeState?: null|RuntimeState|value-of<RuntimeState>,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class ExecuteNewResponse implements BaseModel
{
    /** @use SdkModel<ExecuteNewResponseShape> */
    use SdkModel;

    #[Optional('agentId')]
    public ?string $agentID;

    #[Optional]
    public ?string $message;

    /** @var value-of<Provider>|null $provider */
    #[Optional(enum: Provider::class)]
    public ?string $provider;

    #[Optional('runId')]
    public ?string $runID;

    /** @var value-of<RuntimeState>|null $runtimeState */
    #[Optional(enum: RuntimeState::class)]
    public ?string $runtimeState;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

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
     * @param RuntimeState|value-of<RuntimeState>|null $runtimeState
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $agentID = null,
        ?string $message = null,
        Provider|string|null $provider = null,
        ?string $runID = null,
        RuntimeState|string|null $runtimeState = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $agentID && $self['agentID'] = $agentID;
        null !== $message && $self['message'] = $message;
        null !== $provider && $self['provider'] = $provider;
        null !== $runID && $self['runID'] = $runID;
        null !== $runtimeState && $self['runtimeState'] = $runtimeState;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withAgentID(string $agentID): self
    {
        $self = clone $this;
        $self['agentID'] = $agentID;

        return $self;
    }

    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * @param Provider|value-of<Provider> $provider
     */
    public function withProvider(Provider|string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

        return $self;
    }

    /**
     * @param RuntimeState|value-of<RuntimeState> $runtimeState
     */
    public function withRuntimeState(RuntimeState|string $runtimeState): self
    {
        $self = clone $this;
        $self['runtimeState'] = $runtimeState;

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
}
