<?php

declare(strict_types=1);

namespace Casedev\Convert\V1;

use Casedev\Convert\V1\V1ProcessResponse\Status;
use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type V1ProcessResponseShape = array{
 *   job_id?: string|null, message?: string|null, status?: value-of<Status>|null
 * }
 */
final class V1ProcessResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<V1ProcessResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Unique identifier for the conversion job.
     */
    #[Api(optional: true)]
    public ?string $job_id;

    /**
     * Instructions for checking job status.
     */
    #[Api(optional: true)]
    public ?string $message;

    /**
     * Current status of the conversion job.
     *
     * @var value-of<Status>|null $status
     */
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
        ?string $job_id = null,
        ?string $message = null,
        Status|string|null $status = null
    ): self {
        $obj = new self;

        null !== $job_id && $obj->job_id = $job_id;
        null !== $message && $obj->message = $message;
        null !== $status && $obj['status'] = $status;

        return $obj;
    }

    /**
     * Unique identifier for the conversion job.
     */
    public function withJobID(string $jobID): self
    {
        $obj = clone $this;
        $obj->job_id = $jobID;

        return $obj;
    }

    /**
     * Instructions for checking job status.
     */
    public function withMessage(string $message): self
    {
        $obj = clone $this;
        $obj->message = $message;

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
