<?php

declare(strict_types=1);

namespace Router\Vault\Objects;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Vault\Objects\ObjectGetSummarizeJobResponse\Status;

/**
 * @phpstan-type ObjectGetSummarizeJobResponseShape = array{
 *   completedAt?: \DateTimeInterface|null,
 *   createdAt?: \DateTimeInterface|null,
 *   error?: string|null,
 *   jobID?: string|null,
 *   resultFilename?: string|null,
 *   resultObjectID?: string|null,
 *   sourceObjectID?: string|null,
 *   status?: null|Status|value-of<Status>,
 *   workflowType?: string|null,
 * }
 */
final class ObjectGetSummarizeJobResponse implements BaseModel
{
    /** @use SdkModel<ObjectGetSummarizeJobResponseShape> */
    use SdkModel;

    /**
     * When the job completed.
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $completedAt;

    /**
     * When the job was created.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * Error message (if failed).
     */
    #[Optional(nullable: true)]
    public ?string $error;

    /**
     * Case.dev job ID.
     */
    #[Optional('jobId')]
    public ?string $jobID;

    /**
     * Filename of the result document (if completed).
     */
    #[Optional(nullable: true)]
    public ?string $resultFilename;

    /**
     * ID of the result document (if completed).
     */
    #[Optional('resultObjectId', nullable: true)]
    public ?string $resultObjectID;

    /**
     * ID of the source document.
     */
    #[Optional('sourceObjectId')]
    public ?string $sourceObjectID;

    /**
     * Current job status.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Type of workflow being executed.
     */
    #[Optional]
    public ?string $workflowType;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?\DateTimeInterface $completedAt = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $error = null,
        ?string $jobID = null,
        ?string $resultFilename = null,
        ?string $resultObjectID = null,
        ?string $sourceObjectID = null,
        Status|string|null $status = null,
        ?string $workflowType = null,
    ): self {
        $self = new self;

        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $error && $self['error'] = $error;
        null !== $jobID && $self['jobID'] = $jobID;
        null !== $resultFilename && $self['resultFilename'] = $resultFilename;
        null !== $resultObjectID && $self['resultObjectID'] = $resultObjectID;
        null !== $sourceObjectID && $self['sourceObjectID'] = $sourceObjectID;
        null !== $status && $self['status'] = $status;
        null !== $workflowType && $self['workflowType'] = $workflowType;

        return $self;
    }

    /**
     * When the job completed.
     */
    public function withCompletedAt(?\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

        return $self;
    }

    /**
     * When the job was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Error message (if failed).
     */
    public function withError(?string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Case.dev job ID.
     */
    public function withJobID(string $jobID): self
    {
        $self = clone $this;
        $self['jobID'] = $jobID;

        return $self;
    }

    /**
     * Filename of the result document (if completed).
     */
    public function withResultFilename(?string $resultFilename): self
    {
        $self = clone $this;
        $self['resultFilename'] = $resultFilename;

        return $self;
    }

    /**
     * ID of the result document (if completed).
     */
    public function withResultObjectID(?string $resultObjectID): self
    {
        $self = clone $this;
        $self['resultObjectID'] = $resultObjectID;

        return $self;
    }

    /**
     * ID of the source document.
     */
    public function withSourceObjectID(string $sourceObjectID): self
    {
        $self = clone $this;
        $self['sourceObjectID'] = $sourceObjectID;

        return $self;
    }

    /**
     * Current job status.
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
     * Type of workflow being executed.
     */
    public function withWorkflowType(string $workflowType): self
    {
        $self = clone $this;
        $self['workflowType'] = $workflowType;

        return $self;
    }
}
