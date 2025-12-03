<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1\V1ListExecutionsResponse;

use Casedev\Core\Attributes\Api;
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

    #[Api(optional: true)]
    public ?string $id;

    #[Api(optional: true)]
    public ?string $completedAt;

    #[Api(optional: true)]
    public ?int $durationMs;

    #[Api(optional: true)]
    public ?string $startedAt;

    #[Api(optional: true)]
    public ?string $status;

    #[Api(optional: true)]
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
        $obj = new self;

        null !== $id && $obj->id = $id;
        null !== $completedAt && $obj->completedAt = $completedAt;
        null !== $durationMs && $obj->durationMs = $durationMs;
        null !== $startedAt && $obj->startedAt = $startedAt;
        null !== $status && $obj->status = $status;
        null !== $triggerType && $obj->triggerType = $triggerType;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    public function withCompletedAt(string $completedAt): self
    {
        $obj = clone $this;
        $obj->completedAt = $completedAt;

        return $obj;
    }

    public function withDurationMs(int $durationMs): self
    {
        $obj = clone $this;
        $obj->durationMs = $durationMs;

        return $obj;
    }

    public function withStartedAt(string $startedAt): self
    {
        $obj = clone $this;
        $obj->startedAt = $startedAt;

        return $obj;
    }

    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }

    public function withTriggerType(string $triggerType): self
    {
        $obj = clone $this;
        $obj->triggerType = $triggerType;

        return $obj;
    }
}
