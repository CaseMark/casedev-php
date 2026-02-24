<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ObjectGetResponseShape = array{
 *   id: string,
 *   contentType: string,
 *   createdAt: \DateTimeInterface,
 *   downloadURL: string,
 *   expiresIn: int,
 *   filename: string,
 *   ingestionStatus: string,
 *   vaultID: string,
 *   chunkCount?: int|null,
 *   metadata?: mixed,
 *   pageCount?: int|null,
 *   path?: string|null,
 *   sizeBytes?: int|null,
 *   textLength?: int|null,
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
    #[Required]
    public string $id;

    /**
     * MIME type.
     */
    #[Required]
    public string $contentType;

    /**
     * Upload timestamp.
     */
    #[Required]
    public \DateTimeInterface $createdAt;

    /**
     * Presigned S3 download URL.
     */
    #[Required('downloadUrl')]
    public string $downloadURL;

    /**
     * URL expiration time in seconds.
     */
    #[Required]
    public int $expiresIn;

    /**
     * Original filename.
     */
    #[Required]
    public string $filename;

    /**
     * Processing status (pending, processing, completed, failed).
     */
    #[Required]
    public string $ingestionStatus;

    /**
     * Vault ID.
     */
    #[Required('vaultId')]
    public string $vaultID;

    /**
     * Number of text chunks created.
     */
    #[Optional]
    public ?int $chunkCount;

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
     * Number of embedding vectors generated.
     */
    #[Optional]
    public ?int $vectorCount;

    /**
     * `new ObjectGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ObjectGetResponse::with(
     *   id: ...,
     *   contentType: ...,
     *   createdAt: ...,
     *   downloadURL: ...,
     *   expiresIn: ...,
     *   filename: ...,
     *   ingestionStatus: ...,
     *   vaultID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ObjectGetResponse)
     *   ->withID(...)
     *   ->withContentType(...)
     *   ->withCreatedAt(...)
     *   ->withDownloadURL(...)
     *   ->withExpiresIn(...)
     *   ->withFilename(...)
     *   ->withIngestionStatus(...)
     *   ->withVaultID(...)
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
     */
    public static function with(
        string $id,
        string $contentType,
        \DateTimeInterface $createdAt,
        string $downloadURL,
        int $expiresIn,
        string $filename,
        string $ingestionStatus,
        string $vaultID,
        ?int $chunkCount = null,
        mixed $metadata = null,
        ?int $pageCount = null,
        ?string $path = null,
        ?int $sizeBytes = null,
        ?int $textLength = null,
        ?int $vectorCount = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['contentType'] = $contentType;
        $self['createdAt'] = $createdAt;
        $self['downloadURL'] = $downloadURL;
        $self['expiresIn'] = $expiresIn;
        $self['filename'] = $filename;
        $self['ingestionStatus'] = $ingestionStatus;
        $self['vaultID'] = $vaultID;

        null !== $chunkCount && $self['chunkCount'] = $chunkCount;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $pageCount && $self['pageCount'] = $pageCount;
        null !== $path && $self['path'] = $path;
        null !== $sizeBytes && $self['sizeBytes'] = $sizeBytes;
        null !== $textLength && $self['textLength'] = $textLength;
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
     * Vault ID.
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

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
     * Number of embedding vectors generated.
     */
    public function withVectorCount(int $vectorCount): self
    {
        $self = clone $this;
        $self['vectorCount'] = $vectorCount;

        return $self;
    }
}
