<?php

declare(strict_types=1);

namespace Casedev\Convert\V1;

use Casedev\Convert\V1\V1WebhookParams\Result;
use Casedev\Convert\V1\V1WebhookParams\Status;
use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Internal webhook endpoint that receives completion notifications from the Modal FTR converter service. This endpoint handles status updates for file conversion jobs, including success and failure notifications. Requires valid Bearer token authentication.
 *
 * @see Casedev\Services\Convert\V1Service::webhook()
 *
 * @phpstan-type V1WebhookParamsShape = array{
 *   job_id: string,
 *   status: Status|value-of<Status>,
 *   error?: string,
 *   result?: Result|array{
 *     duration_seconds?: float|null,
 *     file_size_bytes?: int|null,
 *     stored_filename?: string|null,
 *   },
 * }
 */
final class V1WebhookParams implements BaseModel
{
    /** @use SdkModel<V1WebhookParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Unique identifier for the conversion job.
     */
    #[Api]
    public string $job_id;

    /**
     * Status of the conversion job.
     *
     * @var value-of<Status> $status
     */
    #[Api(enum: Status::class)]
    public string $status;

    /**
     * Error message for failed jobs.
     */
    #[Api(optional: true)]
    public ?string $error;

    /**
     * Result data for completed jobs.
     */
    #[Api(optional: true)]
    public ?Result $result;

    /**
     * `new V1WebhookParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1WebhookParams::with(job_id: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1WebhookParams)->withJobID(...)->withStatus(...)
     * ```
     */
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
     * @param Result|array{
     *   duration_seconds?: float|null,
     *   file_size_bytes?: int|null,
     *   stored_filename?: string|null,
     * } $result
     */
    public static function with(
        string $job_id,
        Status|string $status,
        ?string $error = null,
        Result|array|null $result = null,
    ): self {
        $obj = new self;

        $obj['job_id'] = $job_id;
        $obj['status'] = $status;

        null !== $error && $obj['error'] = $error;
        null !== $result && $obj['result'] = $result;

        return $obj;
    }

    /**
     * Unique identifier for the conversion job.
     */
    public function withJobID(string $jobID): self
    {
        $obj = clone $this;
        $obj['job_id'] = $jobID;

        return $obj;
    }

    /**
     * Status of the conversion job.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * Error message for failed jobs.
     */
    public function withError(string $error): self
    {
        $obj = clone $this;
        $obj['error'] = $error;

        return $obj;
    }

    /**
     * Result data for completed jobs.
     *
     * @param Result|array{
     *   duration_seconds?: float|null,
     *   file_size_bytes?: int|null,
     *   stored_filename?: string|null,
     * } $result
     */
    public function withResult(Result|array $result): self
    {
        $obj = clone $this;
        $obj['result'] = $result;

        return $obj;
    }
}
