<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects\ObjectListResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ObjectShape = array{
 *   id?: string|null,
 *   chunkCount?: float|null,
 *   contentType?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   filename?: string|null,
 *   ingestionCompletedAt?: \DateTimeInterface|null,
 *   ingestionStatus?: string|null,
 *   metadata?: mixed,
 *   pageCount?: float|null,
 *   path?: string|null,
 *   sizeBytes?: float|null,
 *   tags?: list<string>|null,
 *   textLength?: float|null,
 *   vectorCount?: float|null,
 * }
 */
final class Object_ implements BaseModel
{
    /** @use SdkModel<ObjectShape> */
    use SdkModel;

    /**
     * Unique object identifier.
     */
    #[Optional]
    public ?string $id;

    /**
     * Number of text chunks created for vectorization.
     */
    #[Optional]
    public ?float $chunkCount;

    /**
     * MIME type of the document.
     */
    #[Optional]
    public ?string $contentType;

    /**
     * Document upload timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * Original filename of the uploaded document.
     */
    #[Optional]
    public ?string $filename;

    /**
     * Processing completion timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $ingestionCompletedAt;

    /**
     * Processing status of the document.
     */
    #[Optional]
    public ?string $ingestionStatus;

    /**
     * Custom metadata associated with the document.
     */
    #[Optional]
    public mixed $metadata;

    /**
     * Number of pages in the document.
     */
    #[Optional]
    public ?float $pageCount;

    /**
     * Optional folder path for hierarchy preservation from source systems.
     */
    #[Optional(nullable: true)]
    public ?string $path;

    /**
     * File size in bytes.
     */
    #[Optional]
    public ?float $sizeBytes;

    /**
     * Custom tags associated with the document.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Total character count of extracted text.
     */
    #[Optional]
    public ?float $textLength;

    /**
     * Number of vectors generated for semantic search.
     */
    #[Optional]
    public ?float $vectorCount;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $tags
     */
    public static function with(
        ?string $id = null,
        ?float $chunkCount = null,
        ?string $contentType = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $filename = null,
        ?\DateTimeInterface $ingestionCompletedAt = null,
        ?string $ingestionStatus = null,
        mixed $metadata = null,
        ?float $pageCount = null,
        ?string $path = null,
        ?float $sizeBytes = null,
        ?array $tags = null,
        ?float $textLength = null,
        ?float $vectorCount = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $chunkCount && $self['chunkCount'] = $chunkCount;
        null !== $contentType && $self['contentType'] = $contentType;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $filename && $self['filename'] = $filename;
        null !== $ingestionCompletedAt && $self['ingestionCompletedAt'] = $ingestionCompletedAt;
        null !== $ingestionStatus && $self['ingestionStatus'] = $ingestionStatus;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $pageCount && $self['pageCount'] = $pageCount;
        null !== $path && $self['path'] = $path;
        null !== $sizeBytes && $self['sizeBytes'] = $sizeBytes;
        null !== $tags && $self['tags'] = $tags;
        null !== $textLength && $self['textLength'] = $textLength;
        null !== $vectorCount && $self['vectorCount'] = $vectorCount;

        return $self;
    }

    /**
     * Unique object identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Number of text chunks created for vectorization.
     */
    public function withChunkCount(float $chunkCount): self
    {
        $self = clone $this;
        $self['chunkCount'] = $chunkCount;

        return $self;
    }

    /**
     * MIME type of the document.
     */
    public function withContentType(string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }

    /**
     * Document upload timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Original filename of the uploaded document.
     */
    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }

    /**
     * Processing completion timestamp.
     */
    public function withIngestionCompletedAt(
        \DateTimeInterface $ingestionCompletedAt
    ): self {
        $self = clone $this;
        $self['ingestionCompletedAt'] = $ingestionCompletedAt;

        return $self;
    }

    /**
     * Processing status of the document.
     */
    public function withIngestionStatus(string $ingestionStatus): self
    {
        $self = clone $this;
        $self['ingestionStatus'] = $ingestionStatus;

        return $self;
    }

    /**
     * Custom metadata associated with the document.
     */
    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Number of pages in the document.
     */
    public function withPageCount(float $pageCount): self
    {
        $self = clone $this;
        $self['pageCount'] = $pageCount;

        return $self;
    }

    /**
     * Optional folder path for hierarchy preservation from source systems.
     */
    public function withPath(?string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * File size in bytes.
     */
    public function withSizeBytes(float $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    /**
     * Custom tags associated with the document.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Total character count of extracted text.
     */
    public function withTextLength(float $textLength): self
    {
        $self = clone $this;
        $self['textLength'] = $textLength;

        return $self;
    }

    /**
     * Number of vectors generated for semantic search.
     */
    public function withVectorCount(float $vectorCount): self
    {
        $self = clone $this;
        $self['vectorCount'] = $vectorCount;

        return $self;
    }
}
