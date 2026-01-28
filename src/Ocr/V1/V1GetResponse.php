<?php

declare(strict_types=1);

namespace Casedev\Ocr\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Ocr\V1\V1GetResponse\Status;

/**
 * @phpstan-type V1GetResponseShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   status: Status|value-of<Status>,
 *   completedAt?: \DateTimeInterface|null,
 *   metadata?: mixed,
 *   pageCount?: int|null,
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
    #[Required]
    public string $id;

    /**
     * Job creation timestamp.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Current job status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Job completion timestamp.
     */
    #[Optional('completed_at')]
    public ?\DateTimeInterface $completedAt;

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
     * Extracted text content (when completed).
     */
    #[Optional]
    public ?string $text;

    /**
     * `new V1GetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1GetResponse::with(id: ..., createdAt: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1GetResponse)->withID(...)->withCreatedAt(...)->withStatus(...)
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
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        Status|string $status,
        ?\DateTimeInterface $completedAt = null,
        mixed $metadata = null,
        ?int $pageCount = null,
        ?string $text = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['status'] = $status;

        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $pageCount && $self['pageCount'] = $pageCount;
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
     * Job creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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
     * Job completion timestamp.
     */
    public function withCompletedAt(\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

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
     * Extracted text content (when completed).
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
