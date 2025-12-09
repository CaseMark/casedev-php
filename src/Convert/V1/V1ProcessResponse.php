<?php

declare(strict_types=1);

namespace Casedev\Convert\V1;

use Casedev\Convert\V1\V1ProcessResponse\Status;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type V1ProcessResponseShape = array{
 *   jobID?: string|null, message?: string|null, status?: value-of<Status>|null
 * }
 */
final class V1ProcessResponse implements BaseModel
{
    /** @use SdkModel<V1ProcessResponseShape> */
    use SdkModel;

    /**
     * Unique identifier for the conversion job.
     */
    #[Optional('job_id')]
    public ?string $jobID;

    /**
     * Instructions for checking job status.
     */
    #[Optional]
    public ?string $message;

    /**
     * Current status of the conversion job.
     *
     * @var value-of<Status>|null $status
     */
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
        ?string $jobID = null,
        ?string $message = null,
        Status|string|null $status = null
    ): self {
        $obj = new self;

        null !== $jobID && $obj['jobID'] = $jobID;
        null !== $message && $obj['message'] = $message;
        null !== $status && $obj['status'] = $status;

        return $obj;
    }

    /**
     * Unique identifier for the conversion job.
     */
    public function withJobID(string $jobID): self
    {
        $obj = clone $this;
        $obj['jobID'] = $jobID;

        return $obj;
    }

    /**
     * Instructions for checking job status.
     */
    public function withMessage(string $message): self
    {
        $obj = clone $this;
        $obj['message'] = $message;

        return $obj;
    }

    /**
     * Current status of the conversion job.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }
}
