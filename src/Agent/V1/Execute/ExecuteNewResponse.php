<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Execute;

use CaseDev\Agent\V1\Execute\ExecuteNewResponse\Status;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ExecuteNewResponseShape = array{
 *   agentID?: string|null,
 *   message?: string|null,
 *   runID?: string|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class ExecuteNewResponse implements BaseModel
{
    /** @use SdkModel<ExecuteNewResponseShape> */
    use SdkModel;

    /**
     * Ephemeral agent ID (auto-created).
     */
    #[Optional('agentId')]
    public ?string $agentID;

    #[Optional]
    public ?string $message;

    /**
     * Run ID — poll /agent/v1/run/:id/status.
     */
    #[Optional('runId')]
    public ?string $runID;

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
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $agentID = null,
        ?string $message = null,
        ?string $runID = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $agentID && $self['agentID'] = $agentID;
        null !== $message && $self['message'] = $message;
        null !== $runID && $self['runID'] = $runID;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Ephemeral agent ID (auto-created).
     */
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
     * Run ID — poll /agent/v1/run/:id/status.
     */
    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

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
