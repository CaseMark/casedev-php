<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects\ObjectListResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ObjectShape = array{
 *   id: string,
 *   contentType: string,
 *   createdAt: \DateTimeInterface,
 *   filename: string,
 *   ingestionStatus: string,
 *   chunkCount?: float|null,
 *   ingestionCompletedAt?: \DateTimeInterface|null,
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
    #[Required]
    public string $id;

    /**
     * MIME type of the document.
     */
    #[Required]
    public string $contentType;

    /**
     * Document upload timestamp.
     */
    #[Required]
    public \DateTimeInterface $createdAt;

    /**
     * Original filename of the uploaded document.
     */
    #[Required]
    public string $filename;

    /**
     * Processing status of the document.
     */
    #[Required]
    public string $ingestionStatus;

    /**
     * Number of text chunks created for vectorization.
     */
    #[Optional]
    public ?float $chunkCount;

    /**
     * Processing completion timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $ingestionCompletedAt;

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

    /**
     * `new Object_()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Object_::with(
     *   id: ..., contentType: ..., createdAt: ..., filename: ..., ingestionStatus: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Object_)
     *   ->withID(...)
     *   ->withContentType(...)
     *   ->withCreatedAt(...)
     *   ->withFilename(...)
     *   ->withIngestionStatus(...)
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
     * @param list<string>|null $tags
     */
    public static function with(
        string $id,
        string $contentType,
        \DateTimeInterface $createdAt,
        string $filename,
        string $ingestionStatus,
        ?float $chunkCount = null,
        ?\DateTimeInterface $ingestionCompletedAt = null,
        mixed $metadata = null,
        ?float $pageCount = null,
        ?string $path = null,
        ?float $sizeBytes = null,
        ?array $tags = null,
        ?float $textLength = null,
        ?float $vectorCount = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['contentType'] = $contentType;
        $self['createdAt'] = $createdAt;
        $self['filename'] = $filename;
        $self['ingestionStatus'] = $ingestionStatus;

        null !== $chunkCount && $self['chunkCount'] = $chunkCount;
        null !== $ingestionCompletedAt && $self['ingestionCompletedAt'] = $ingestionCompletedAt;
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
     * Processing status of the document.
     */
    public function withIngestionStatus(string $ingestionStatus): self
    {
        $self = clone $this;
        $self['ingestionStatus'] = $ingestionStatus;

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
