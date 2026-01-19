<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ObjectGetResponseShape = array{
 *   id?: string|null,
 *   chunkCount?: int|null,
 *   contentType?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   downloadURL?: string|null,
 *   expiresIn?: int|null,
 *   filename?: string|null,
 *   ingestionStatus?: string|null,
 *   metadata?: mixed,
 *   pageCount?: int|null,
 *   path?: string|null,
 *   sizeBytes?: int|null,
 *   textLength?: int|null,
 *   vaultID?: string|null,
 *   vectorCount?: int|null,
 * }
 */
final class ObjectGetResponse implements BaseModel
{
    /** @use SdkModel<ObjectGetResponseShape> */
    use SdkModel;

    /**
     * Object ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * Number of text chunks created.
     */
    #[Optional]
    public ?int $chunkCount;

    /**
     * MIME type.
     */
    #[Optional]
    public ?string $contentType;

    /**
     * Upload timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * Presigned S3 download URL.
     */
    #[Optional('downloadUrl')]
    public ?string $downloadURL;

    /**
     * URL expiration time in seconds.
     */
    #[Optional]
    public ?int $expiresIn;

    /**
     * Original filename.
     */
    #[Optional]
    public ?string $filename;

    /**
     * Processing status (pending, processing, completed, failed).
     */
    #[Optional]
    public ?string $ingestionStatus;

    /**
     * Additional metadata.
     */
    #[Optional]
    public mixed $metadata;

    /**
     * Number of pages (for documents).
     */
    #[Optional]
    public ?int $pageCount;

    /**
     * Optional folder path for hierarchy preservation.
     */
    #[Optional(nullable: true)]
    public ?string $path;

    /**
     * File size in bytes.
     */
    #[Optional]
    public ?int $sizeBytes;

    /**
     * Length of extracted text.
     */
    #[Optional]
    public ?int $textLength;

    /**
     * Vault ID.
     */
    #[Optional('vaultId')]
    public ?string $vaultID;

    /**
     * Number of embedding vectors generated.
     */
    #[Optional]
    public ?int $vectorCount;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $id = null,
        ?int $chunkCount = null,
        ?string $contentType = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $downloadURL = null,
        ?int $expiresIn = null,
        ?string $filename = null,
        ?string $ingestionStatus = null,
        mixed $metadata = null,
        ?int $pageCount = null,
        ?string $path = null,
        ?int $sizeBytes = null,
        ?int $textLength = null,
        ?string $vaultID = null,
        ?int $vectorCount = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $chunkCount && $self['chunkCount'] = $chunkCount;
        null !== $contentType && $self['contentType'] = $contentType;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $downloadURL && $self['downloadURL'] = $downloadURL;
        null !== $expiresIn && $self['expiresIn'] = $expiresIn;
        null !== $filename && $self['filename'] = $filename;
        null !== $ingestionStatus && $self['ingestionStatus'] = $ingestionStatus;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $pageCount && $self['pageCount'] = $pageCount;
        null !== $path && $self['path'] = $path;
        null !== $sizeBytes && $self['sizeBytes'] = $sizeBytes;
        null !== $textLength && $self['textLength'] = $textLength;
        null !== $vaultID && $self['vaultID'] = $vaultID;
        null !== $vectorCount && $self['vectorCount'] = $vectorCount;

        return $self;
    }

    /**
     * Object ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Number of text chunks created.
     */
    public function withChunkCount(int $chunkCount): self
    {
        $self = clone $this;
        $self['chunkCount'] = $chunkCount;

        return $self;
    }

    /**
     * MIME type.
     */
    public function withContentType(string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }

    /**
     * Upload timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Presigned S3 download URL.
     */
    public function withDownloadURL(string $downloadURL): self
    {
        $self = clone $this;
        $self['downloadURL'] = $downloadURL;

        return $self;
    }

    /**
     * URL expiration time in seconds.
     */
    public function withExpiresIn(int $expiresIn): self
    {
        $self = clone $this;
        $self['expiresIn'] = $expiresIn;

        return $self;
    }

    /**
     * Original filename.
     */
    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }

    /**
     * Processing status (pending, processing, completed, failed).
     */
    public function withIngestionStatus(string $ingestionStatus): self
    {
        $self = clone $this;
        $self['ingestionStatus'] = $ingestionStatus;

        return $self;
    }

    /**
     * Additional metadata.
     */
    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Number of pages (for documents).
     */
    public function withPageCount(int $pageCount): self
    {
        $self = clone $this;
        $self['pageCount'] = $pageCount;

        return $self;
    }

    /**
     * Optional folder path for hierarchy preservation.
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
    public function withSizeBytes(int $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    /**
     * Length of extracted text.
     */
    public function withTextLength(int $textLength): self
    {
        $self = clone $this;
        $self['textLength'] = $textLength;

        return $self;
    }

    /**
     * Vault ID.
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * Number of embedding vectors generated.
     */
    public function withVectorCount(int $vectorCount): self
    {
        $self = clone $this;
        $self['vectorCount'] = $vectorCount;

        return $self;
    }
}
