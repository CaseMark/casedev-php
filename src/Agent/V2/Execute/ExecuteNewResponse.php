<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Execute;

use CaseDev\Agent\V2\Execute\ExecuteNewResponse\Logs;
use CaseDev\Agent\V2\Execute\ExecuteNewResponse\Provider;
use CaseDev\Agent\V2\Execute\ExecuteNewResponse\RuntimeState;
use CaseDev\Agent\V2\Execute\ExecuteNewResponse\Status;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type LogsShape from \CaseDev\Agent\V2\Execute\ExecuteNewResponse\Logs
 *
 * @phpstan-type ExecuteNewResponseShape = array{
 *   agentID?: string|null,
 *   error?: string|null,
 *   logs?: null|Logs|LogsShape,
 *   message?: string|null,
 *   output?: string|null,
 *   provider?: null|Provider|value-of<Provider>,
 *   runID?: string|null,
 *   runtimeID?: string|null,
 *   runtimeState?: null|RuntimeState|value-of<RuntimeState>,
 *   status?: null|Status|value-of<Status>,
 *   usage?: mixed,
 * }
 */
final class ExecuteNewResponse implements BaseModel
{
    /** @use SdkModel<ExecuteNewResponseShape> */
    use SdkModel;

    #[Optional('agentId')]
    public ?string $agentID;

    #[Optional(nullable: true)]
    public ?string $error;

    #[Optional(nullable: true)]
    public ?Logs $logs;

    #[Optional(nullable: true)]
    public ?string $message;

    #[Optional(nullable: true)]
    public ?string $output;

    /** @var value-of<Provider>|null $provider */
    #[Optional(enum: Provider::class)]
    public ?string $provider;

    #[Optional('runId')]
    public ?string $runID;

    #[Optional('runtimeId', nullable: true)]
    public ?string $runtimeID;

    /** @var value-of<RuntimeState>|null $runtimeState */
    #[Optional(enum: RuntimeState::class)]
    public ?string $runtimeState;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    #[Optional(nullable: true)]
    public mixed $usage;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Logs|LogsShape|null $logs
     * @param Provider|value-of<Provider>|null $provider
     * @param RuntimeState|value-of<RuntimeState>|null $runtimeState
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $agentID = null,
        ?string $error = null,
        Logs|array|null $logs = null,
        ?string $message = null,
        ?string $output = null,
        Provider|string|null $provider = null,
        ?string $runID = null,
        ?string $runtimeID = null,
        RuntimeState|string|null $runtimeState = null,
        Status|string|null $status = null,
        mixed $usage = null,
    ): self {
        $self = new self;

        null !== $agentID && $self['agentID'] = $agentID;
        null !== $error && $self['error'] = $error;
        null !== $logs && $self['logs'] = $logs;
        null !== $message && $self['message'] = $message;
        null !== $output && $self['output'] = $output;
        null !== $provider && $self['provider'] = $provider;
        null !== $runID && $self['runID'] = $runID;
        null !== $runtimeID && $self['runtimeID'] = $runtimeID;
        null !== $runtimeState && $self['runtimeState'] = $runtimeState;
        null !== $status && $self['status'] = $status;
        null !== $usage && $self['usage'] = $usage;

        return $self;
    }

    public function withAgentID(string $agentID): self
    {
        $self = clone $this;
        $self['agentID'] = $agentID;

        return $self;
    }

    public function withError(?string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * @param Logs|LogsShape|null $logs
     */
    public function withLogs(Logs|array|null $logs): self
    {
        $self = clone $this;
        $self['logs'] = $logs;

        return $self;
    }

    public function withMessage(?string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    public function withOutput(?string $output): self
    {
        $self = clone $this;
        $self['output'] = $output;

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

    public function withRuntimeID(?string $runtimeID): self
    {
        $self = clone $this;
        $self['runtimeID'] = $runtimeID;

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

    public function withUsage(mixed $usage): self
    {
        $self = clone $this;
        $self['usage'] = $usage;

        return $self;
    }
}
