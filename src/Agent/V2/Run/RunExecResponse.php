<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Run;

use CaseDev\Agent\V2\Run\RunExecResponse\Provider;
use CaseDev\Agent\V2\Run\RunExecResponse\RuntimeState;
use CaseDev\Agent\V2\Run\RunExecResponse\Status;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type RunExecResponseShape = array{
 *   id?: string|null,
 *   message?: string|null,
 *   provider?: null|Provider|value-of<Provider>,
 *   runtimeState?: null|RuntimeState|value-of<RuntimeState>,
 *   status?: null|Status|value-of<Status>,
 *   workflowID?: string|null,
 * }
 */
final class RunExecResponse implements BaseModel
{
    /** @use SdkModel<RunExecResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?string $message;

    /** @var value-of<Provider>|null $provider */
    #[Optional(enum: Provider::class)]
    public ?string $provider;

    /** @var value-of<RuntimeState>|null $runtimeState */
    #[Optional(enum: RuntimeState::class)]
    public ?string $runtimeState;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    #[Optional('workflowId')]
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
     * @param RuntimeState|value-of<RuntimeState>|null $runtimeState
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $id = null,
        ?string $message = null,
        Provider|string|null $provider = null,
        RuntimeState|string|null $runtimeState = null,
        Status|string|null $status = null,
        ?string $workflowID = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $message && $self['message'] = $message;
        null !== $provider && $self['provider'] = $provider;
        null !== $runtimeState && $self['runtimeState'] = $runtimeState;
        null !== $status && $self['status'] = $status;
        null !== $workflowID && $self['workflowID'] = $workflowID;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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

    public function withWorkflowID(string $workflowID): self
    {
        $self = clone $this;
        $self['workflowID'] = $workflowID;

        return $self;
    }
}
