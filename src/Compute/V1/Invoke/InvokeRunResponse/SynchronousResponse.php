<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Invoke\InvokeRunResponse;

use Casedev\Compute\V1\Invoke\InvokeRunResponse\SynchronousResponse\Status;
use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SynchronousResponseShape = array{
 *   duration?: float|null,
 *   error?: string|null,
 *   output?: mixed,
 *   runId?: string|null,
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
    #[Api(optional: true)]
    public ?float $duration;

    /**
     * Error message if status is failed.
     */
    #[Api(optional: true)]
    public ?string $error;

    /**
     * Function return value.
     */
    #[Api(optional: true)]
    public mixed $output;

    /**
     * Unique run identifier.
     */
    #[Api(optional: true)]
    public ?string $runId;

    /** @var value-of<Status>|null $status */
    #[Api(enum: Status::class, optional: true)]
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
        ?string $runId = null,
        Status|string|null $status = null,
    ): self {
        $obj = new self;

        null !== $duration && $obj->duration = $duration;
        null !== $error && $obj->error = $error;
        null !== $output && $obj->output = $output;
        null !== $runId && $obj->runId = $runId;
        null !== $status && $obj['status'] = $status;

        return $obj;
    }

    /**
     * Execution duration in milliseconds.
     */
    public function withDuration(float $duration): self
    {
        $obj = clone $this;
        $obj->duration = $duration;

        return $obj;
    }

    /**
     * Error message if status is failed.
     */
    public function withError(string $error): self
    {
        $obj = clone $this;
        $obj->error = $error;

        return $obj;
    }

    /**
     * Function return value.
     */
    public function withOutput(mixed $output): self
    {
        $obj = clone $this;
        $obj->output = $output;

        return $obj;
    }

    /**
     * Unique run identifier.
     */
    public function withRunID(string $runID): self
    {
        $obj = clone $this;
        $obj->runId = $runID;

        return $obj;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }
}
