<?php

declare(strict_types=1);

namespace Casedev\Ocr\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;
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
final class V1ProcessResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<V1ProcessResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Unique job identifier.
     */
    #[Api(optional: true)]
    public ?string $id;

    /**
     * Job creation timestamp.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $created_at;

    /**
     * Document identifier.
     */
    #[Api(optional: true)]
    public ?string $document_id;

    /**
     * OCR engine used.
     */
    #[Api(optional: true)]
    public ?string $engine;

    /**
     * Estimated completion time.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $estimated_completion;

    /**
     * Number of pages detected.
     */
    #[Api(optional: true)]
    public ?int $page_count;

    /**
     * Current job status.
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
