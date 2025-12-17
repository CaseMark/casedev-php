<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Workflows\V1\V1ExecuteResponse\Mode;
use Casedev\Workflows\V1\V1ExecuteResponse\Status;

/**
 * @phpstan-type V1ExecuteResponseShape = array{
 *   duration?: int|null,
 *   executionArn?: string|null,
 *   executionID?: string|null,
 *   mode?: null|Mode|value-of<Mode>,
 *   output?: mixed,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class V1ExecuteResponse implements BaseModel
{
    /** @use SdkModel<V1ExecuteResponseShape> */
    use SdkModel;

    #[Optional]
    public ?int $duration;

    #[Optional]
    public ?string $executionArn;

    #[Optional('executionId')]
    public ?string $executionID;

    /** @var value-of<Mode>|null $mode */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    #[Optional]
    public mixed $output;

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
     * @param Mode|value-of<Mode> $mode
     * @param Status|value-of<Status> $status
     */
    public static function with(
        ?int $duration = null,
        ?string $executionArn = null,
        ?string $executionID = null,
        Mode|string|null $mode = null,
        mixed $output = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $duration && $self['duration'] = $duration;
        null !== $executionArn && $self['executionArn'] = $executionArn;
        null !== $executionID && $self['executionID'] = $executionID;
        null !== $mode && $self['mode'] = $mode;
        null !== $output && $self['output'] = $output;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withDuration(int $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    public function withExecutionArn(string $executionArn): self
    {
        $self = clone $this;
        $self['executionArn'] = $executionArn;

        return $self;
    }

    public function withExecutionID(string $executionID): self
    {
        $self = clone $this;
        $self['executionID'] = $executionID;

        return $self;
    }

    /**
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }

    public function withOutput(mixed $output): self
    {
        $self = clone $this;
        $self['output'] = $output;

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
