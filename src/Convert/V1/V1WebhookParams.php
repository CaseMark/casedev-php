<?php

declare(strict_types=1);

namespace Casedev\Convert\V1;

use Casedev\Convert\V1\V1WebhookParams\Result;
use Casedev\Convert\V1\V1WebhookParams\Status;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Internal webhook endpoint that receives completion notifications from the Modal FTR converter service. This endpoint handles status updates for file conversion jobs, including success and failure notifications. Requires valid Bearer token authentication.
 *
 * @see Casedev\Services\Convert\V1Service::webhook()
 *
 * @phpstan-import-type ResultShape from \Casedev\Convert\V1\V1WebhookParams\Result
 *
 * @phpstan-type V1WebhookParamsShape = array{
 *   jobID: string,
 *   status: Status|value-of<Status>,
 *   error?: string|null,
 *   result?: null|Result|ResultShape,
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
    #[Required('job_id')]
    public string $jobID;

    /**
     * Status of the conversion job.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Error message for failed jobs.
     */
    #[Optional]
    public ?string $error;

    /**
     * Result data for completed jobs.
     */
    #[Optional]
    public ?Result $result;

    /**
     * `new V1WebhookParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1WebhookParams::with(jobID: ..., status: ...)
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
     * @param Result|ResultShape|null $result
     */
    public static function with(
        string $jobID,
        Status|string $status,
        ?string $error = null,
        Result|array|null $result = null,
    ): self {
        $self = new self;

        $self['jobID'] = $jobID;
        $self['status'] = $status;

        null !== $error && $self['error'] = $error;
        null !== $result && $self['result'] = $result;

        return $self;
    }

    /**
     * Unique identifier for the conversion job.
     */
    public function withJobID(string $jobID): self
    {
        $self = clone $this;
        $self['jobID'] = $jobID;

        return $self;
    }

    /**
     * Status of the conversion job.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Error message for failed jobs.
     */
    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Result data for completed jobs.
     *
     * @param Result|ResultShape $result
     */
    public function withResult(Result|array $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }
}
