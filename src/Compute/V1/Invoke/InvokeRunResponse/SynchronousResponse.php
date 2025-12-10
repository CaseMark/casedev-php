<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Invoke\InvokeRunResponse;

use Casedev\Compute\V1\Invoke\InvokeRunResponse\SynchronousResponse\Status;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SynchronousResponseShape = array{
 *   duration?: float|null,
 *   error?: string|null,
 *   output?: mixed,
 *   runID?: string|null,
 *   status?: value-of<Status>|null,
 * }
 */
final class SynchronousResponse implements BaseModel
{
    /** @use SdkModel<SynchronousResponseShape> */
    use SdkModel;

    /**
     * Execution duration in milliseconds.
     */
    #[Optional]
    public ?float $duration;

    /**
     * Error message if status is failed.
     */
    #[Optional]
    public ?string $error;

    /**
     * Function return value.
     */
    #[Optional]
    public mixed $output;

    /**
     * Unique run identifier.
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
     * @param Status|value-of<Status> $status
     */
    public static function with(
        ?float $duration = null,
        ?string $error = null,
        mixed $output = null,
        ?string $runID = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $duration && $self['duration'] = $duration;
        null !== $error && $self['error'] = $error;
        null !== $output && $self['output'] = $output;
        null !== $runID && $self['runID'] = $runID;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Execution duration in milliseconds.
     */
    public function withDuration(float $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * Error message if status is failed.
     */
    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Function return value.
     */
    public function withOutput(mixed $output): self
    {
        $self = clone $this;
        $self['output'] = $output;

        return $self;
    }

    /**
     * Unique run identifier.
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
