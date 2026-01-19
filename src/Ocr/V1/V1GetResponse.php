<?php

declare(strict_types=1);

namespace Casedev\Ocr\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Ocr\V1\V1GetResponse\Status;

/**
 * @phpstan-type V1GetResponseShape = array{
 *   id?: string|null,
 *   completedAt?: \DateTimeInterface|null,
 *   createdAt?: \DateTimeInterface|null,
 *   metadata?: mixed,
 *   pageCount?: int|null,
 *   status?: null|Status|value-of<Status>,
 *   text?: string|null,
 * }
 */
final class V1GetResponse implements BaseModel
{
    /** @use SdkModel<V1GetResponseShape> */
    use SdkModel;

    /**
     * OCR job ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * Job completion timestamp.
     */
    #[Optional('completed_at')]
    public ?\DateTimeInterface $completedAt;

    /**
     * Job creation timestamp.
     */
    #[Optional('created_at')]
    public ?\DateTimeInterface $createdAt;

    /**
     * Additional processing metadata.
     */
    #[Optional]
    public mixed $metadata;

    /**
     * Number of pages processed.
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

    /**
     * Extracted text content (when completed).
     */
    #[Optional]
    public ?string $text;

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
        ?string $id = null,
        ?\DateTimeInterface $completedAt = null,
        ?\DateTimeInterface $createdAt = null,
        mixed $metadata = null,
        ?int $pageCount = null,
        Status|string|null $status = null,
        ?string $text = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $pageCount && $self['pageCount'] = $pageCount;
        null !== $status && $self['status'] = $status;
        null !== $text && $self['text'] = $text;

        return $self;
    }

    /**
     * OCR job ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Job completion timestamp.
     */
    public function withCompletedAt(\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

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
     * Additional processing metadata.
     */
    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Number of pages processed.
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

    /**
     * Extracted text content (when completed).
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
