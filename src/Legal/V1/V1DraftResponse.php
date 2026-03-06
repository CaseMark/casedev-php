<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1DraftResponse\Status;

/**
 * @phpstan-type V1DraftResponseShape = array{
 *   agentID?: string|null,
 *   message?: string|null,
 *   runID?: string|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class V1DraftResponse implements BaseModel
{
    /** @use SdkModel<V1DraftResponseShape> */
    use SdkModel;

    /**
     * Ephemeral agent ID.
     */
    #[Optional('agent_id')]
    public ?string $agentID;

    #[Optional]
    public ?string $message;

    /**
     * Run ID — poll /agent/v1/run/:id/status for progress.
     */
    #[Optional('run_id')]
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
     * Ephemeral agent ID.
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
     * Run ID — poll /agent/v1/run/:id/status for progress.
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
