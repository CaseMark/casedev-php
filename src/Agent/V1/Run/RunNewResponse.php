<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run;

use CaseDev\Agent\V1\Run\RunNewResponse\Status;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type RunNewResponseShape = array{
 *   id?: string|null,
 *   agentID?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class RunNewResponse implements BaseModel
{
    /** @use SdkModel<RunNewResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional('agentId')]
    public ?string $agentID;

    #[Optional]
    public ?\DateTimeInterface $createdAt;

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
        ?string $id = null,
        ?string $agentID = null,
        ?\DateTimeInterface $createdAt = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $agentID && $self['agentID'] = $agentID;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $status && $self['status'] = $status;

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

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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
