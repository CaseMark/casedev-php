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
 *   status?: value-of<Status>|null,
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
        $obj = new self;

        null !== $id && $obj['id'] = $id;
        null !== $createdAt && $obj['createdAt'] = $createdAt;
        null !== $documentID && $obj['documentID'] = $documentID;
        null !== $engine && $obj['engine'] = $engine;
        null !== $estimatedCompletion && $obj['estimatedCompletion'] = $estimatedCompletion;
        null !== $pageCount && $obj['pageCount'] = $pageCount;
        null !== $status && $obj['status'] = $status;

        return $obj;
    }

    /**
     * Unique job identifier.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * Job creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * Document identifier.
     */
    public function withDocumentID(string $documentID): self
    {
        $obj = clone $this;
        $obj['documentID'] = $documentID;

        return $obj;
    }

    /**
     * OCR engine used.
     */
    public function withEngine(string $engine): self
    {
        $obj = clone $this;
        $obj['engine'] = $engine;

        return $obj;
    }

    /**
     * Estimated completion time.
     */
    public function withEstimatedCompletion(
        \DateTimeInterface $estimatedCompletion
    ): self {
        $obj = clone $this;
        $obj['estimatedCompletion'] = $estimatedCompletion;

        return $obj;
    }

    /**
     * Number of pages detected.
     */
    public function withPageCount(int $pageCount): self
    {
        $obj = clone $this;
        $obj['pageCount'] = $pageCount;

        return $obj;
    }

    /**
     * Current job status.
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
