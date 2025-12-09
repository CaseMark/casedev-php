<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Workflows\V1\V1ExecuteResponse\Status;

/**
 * @phpstan-type V1ExecuteResponseShape = array{
 *   duration?: int|null,
 *   error?: string|null,
 *   executionId?: string|null,
 *   outputs?: mixed,
 *   status?: value-of<Status>|null,
 * }
 */
final class V1ExecuteResponse implements BaseModel
{
    /** @use SdkModel<V1ExecuteResponseShape> */
    use SdkModel;

    #[Api(optional: true)]
    public ?int $duration;

    #[Api(optional: true)]
    public ?string $error;

    #[Api(optional: true)]
    public ?string $executionId;

    #[Api(optional: true)]
    public mixed $outputs;

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
        ?int $duration = null,
        ?string $error = null,
        ?string $executionId = null,
        mixed $outputs = null,
        Status|string|null $status = null,
    ): self {
        $obj = new self;

        null !== $duration && $obj['duration'] = $duration;
        null !== $error && $obj['error'] = $error;
        null !== $executionId && $obj['executionId'] = $executionId;
        null !== $outputs && $obj['outputs'] = $outputs;
        null !== $status && $obj['status'] = $status;

        return $obj;
    }

    public function withDuration(int $duration): self
    {
        $obj = clone $this;
        $obj['duration'] = $duration;

        return $obj;
    }

    public function withError(string $error): self
    {
        $obj = clone $this;
        $obj['error'] = $error;

        return $obj;
    }

    public function withExecutionID(string $executionID): self
    {
        $obj = clone $this;
        $obj['executionId'] = $executionID;

        return $obj;
    }

    public function withOutputs(mixed $outputs): self
    {
        $obj = clone $this;
        $obj['outputs'] = $outputs;

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
