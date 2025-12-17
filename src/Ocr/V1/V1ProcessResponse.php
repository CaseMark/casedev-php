<?php

declare(strict_types=1);

namespace Casedev\Ocr\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Ocr\V1\V1ProcessResponse\Status;

/**
 * @phpstan-type V1ProcessResponseShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   documentID?: string|null,
 *   engine?: string|null,
 *   estimatedCompletion?: \DateTimeInterface|null,
 *   pageCount?: int|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class V1ProcessResponse implements BaseModel
{
    /** @use SdkModel<V1ProcessResponseShape> */
    use SdkModel;

    /**
     * Unique job identifier.
     */
    #[Optional]
    public ?string $id;

    /**
     * Job creation timestamp.
     */
    #[Optional('created_at')]
    public ?\DateTimeInterface $createdAt;

    /**
     * Document identifier.
     */
    #[Optional('document_id')]
    public ?string $documentID;

    /**
     * OCR engine used.
     */
    #[Optional]
    public ?string $engine;

    /**
     * Estimated completion time.
     */
    #[Optional('estimated_completion')]
    public ?\DateTimeInterface $estimatedCompletion;

    /**
     * Number of pages detected.
     */
    #[Optional('page_count')]
    public ?int $pageCount;

    /**
     * Current job status.
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
        ?string $id = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $documentID = null,
        ?string $engine = null,
        ?\DateTimeInterface $estimatedCompletion = null,
        ?int $pageCount = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $documentID && $self['documentID'] = $documentID;
        null !== $engine && $self['engine'] = $engine;
        null !== $estimatedCompletion && $self['estimatedCompletion'] = $estimatedCompletion;
        null !== $pageCount && $self['pageCount'] = $pageCount;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Unique job identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Job creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Document identifier.
     */
    public function withDocumentID(string $documentID): self
    {
        $self = clone $this;
        $self['documentID'] = $documentID;

        return $self;
    }

    /**
     * OCR engine used.
     */
    public function withEngine(string $engine): self
    {
        $self = clone $this;
        $self['engine'] = $engine;

        return $self;
    }

    /**
     * Estimated completion time.
     */
    public function withEstimatedCompletion(
        \DateTimeInterface $estimatedCompletion
    ): self {
        $self = clone $this;
        $self['estimatedCompletion'] = $estimatedCompletion;

        return $self;
    }

    /**
     * Number of pages detected.
     */
    public function withPageCount(int $pageCount): self
    {
        $self = clone $this;
        $self['pageCount'] = $pageCount;

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
}
