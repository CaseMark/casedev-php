<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Workflows\V1\V1ExecuteResponse\Status;

/**
 * @phpstan-type V1ExecuteResponseShape = array{
 *   duration?: int|null,
 *   error?: string|null,
 *   executionID?: string|null,
 *   outputs?: mixed,
 *   status?: value-of<Status>|null,
 * }
 */
final class V1ExecuteResponse implements BaseModel
{
    /** @use SdkModel<V1ExecuteResponseShape> */
    use SdkModel;

    #[Optional]
    public ?int $duration;

    #[Optional]
    public ?string $error;

    #[Optional('executionId')]
    public ?string $executionID;

    #[Optional]
    public mixed $outputs;

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
     * @param Status|value-of<Status> $status
     */
    public static function with(
        ?int $duration = null,
        ?string $error = null,
        ?string $executionID = null,
        mixed $outputs = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $duration && $self['duration'] = $duration;
        null !== $error && $self['error'] = $error;
        null !== $executionID && $self['executionID'] = $executionID;
        null !== $outputs && $self['outputs'] = $outputs;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withDuration(int $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    public function withExecutionID(string $executionID): self
    {
        $self = clone $this;
        $self['executionID'] = $executionID;

        return $self;
    }

    public function withOutputs(mixed $outputs): self
    {
        $self = clone $this;
        $self['outputs'] = $outputs;

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
