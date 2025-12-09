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
 *   created_at?: \DateTimeInterface|null,
 *   document_id?: string|null,
 *   engine?: string|null,
 *   estimated_completion?: \DateTimeInterface|null,
 *   page_count?: int|null,
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
    #[Optional]
    public ?\DateTimeInterface $created_at;

    /**
     * Document identifier.
     */
    #[Optional]
    public ?string $document_id;

    /**
     * OCR engine used.
     */
    #[Optional]
    public ?string $engine;

    /**
     * Estimated completion time.
     */
    #[Optional]
    public ?\DateTimeInterface $estimated_completion;

    /**
     * Number of pages detected.
     */
    #[Optional]
    public ?int $page_count;

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
        ?\DateTimeInterface $created_at = null,
        ?string $document_id = null,
        ?string $engine = null,
        ?\DateTimeInterface $estimated_completion = null,
        ?int $page_count = null,
        Status|string|null $status = null,
    ): self {
        $obj = new self;

        null !== $id && $obj['id'] = $id;
        null !== $created_at && $obj['created_at'] = $created_at;
        null !== $document_id && $obj['document_id'] = $document_id;
        null !== $engine && $obj['engine'] = $engine;
        null !== $estimated_completion && $obj['estimated_completion'] = $estimated_completion;
        null !== $page_count && $obj['page_count'] = $page_count;
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
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * Document identifier.
     */
    public function withDocumentID(string $documentID): self
    {
        $obj = clone $this;
        $obj['document_id'] = $documentID;

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
        $obj['estimated_completion'] = $estimatedCompletion;

        return $obj;
    }

    /**
     * Number of pages detected.
     */
    public function withPageCount(int $pageCount): self
    {
        $obj = clone $this;
        $obj['page_count'] = $pageCount;

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
