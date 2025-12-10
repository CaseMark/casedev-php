<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1\V1ListExecutionsResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ExecutionShape = array{
 *   id?: string|null,
 *   completedAt?: string|null,
 *   durationMs?: int|null,
 *   startedAt?: string|null,
 *   status?: string|null,
 *   triggerType?: string|null,
 * }
 */
final class Execution implements BaseModel
{
    /** @use SdkModel<ExecutionShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?string $completedAt;

    #[Optional]
    public ?int $durationMs;

    #[Optional]
    public ?string $startedAt;

    #[Optional]
    public ?string $status;

    #[Optional]
    public ?string $triggerType;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $id = null,
        ?string $completedAt = null,
        ?int $durationMs = null,
        ?string $startedAt = null,
        ?string $status = null,
        ?string $triggerType = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $durationMs && $self['durationMs'] = $durationMs;
        null !== $startedAt && $self['startedAt'] = $startedAt;
        null !== $status && $self['status'] = $status;
        null !== $triggerType && $self['triggerType'] = $triggerType;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCompletedAt(string $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

        return $self;
    }

    public function withDurationMs(int $durationMs): self
    {
        $self = clone $this;
        $self['durationMs'] = $durationMs;

        return $self;
    }

    public function withStartedAt(string $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withTriggerType(string $triggerType): self
    {
        $self = clone $this;
        $self['triggerType'] = $triggerType;

        return $self;
    }
}
