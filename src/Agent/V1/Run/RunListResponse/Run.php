<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunListResponse;

use CaseDev\Agent\V1\Run\RunListResponse\Run\Status;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type RunShape = array{
 *   id?: string|null,
 *   agentID?: string|null,
 *   completedAt?: \DateTimeInterface|null,
 *   createdAt?: \DateTimeInterface|null,
 *   model?: string|null,
 *   prompt?: string|null,
 *   startedAt?: \DateTimeInterface|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class Run implements BaseModel
{
    /** @use SdkModel<RunShape> */
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
    public ?string $model;

    /**
     * Truncated to first 200 characters.
     */
    #[Optional]
    public ?string $prompt;

    #[Optional(nullable: true)]
    public ?\DateTimeInterface $startedAt;

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
        ?\DateTimeInterface $completedAt = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $model = null,
        ?string $prompt = null,
        ?\DateTimeInterface $startedAt = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $agentID && $self['agentID'] = $agentID;
        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $model && $self['model'] = $model;
        null !== $prompt && $self['prompt'] = $prompt;
        null !== $startedAt && $self['startedAt'] = $startedAt;
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

    public function withModel(?string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Truncated to first 200 characters.
     */
    public function withPrompt(string $prompt): self
    {
        $self = clone $this;
        $self['prompt'] = $prompt;

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
}
