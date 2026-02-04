<?php

declare(strict_types=1);

namespace Casedev\Vault\Multipart;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Initiate a multipart upload for large files (>5GB). Returns an uploadId and object metadata. Use part URLs endpoint to upload parts and complete endpoint to finalize.
 *
 * @see Casedev\Services\Vault\MultipartService::init()
 *
 * @phpstan-type MultipartInitParamsShape = array{
 *   contentType: string,
 *   filename: string,
 *   sizeBytes: int,
 *   autoIndex?: bool|null,
 *   metadata?: mixed,
 *   partSizeBytes?: int|null,
 *   path?: string|null,
 * }
 */
final class MultipartInitParams implements BaseModel
{
    /** @use SdkModel<MultipartInitParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * MIME type of the file.
     */
    #[Required]
    public string $contentType;

    /**
     * Name of the file to upload.
     */
    #[Required]
    public string $filename;

    /**
     * File size in bytes (required, max 8GB).
     */
    #[Required]
    public int $sizeBytes;

    /**
     * Whether to automatically process and index the file for search.
     */
    #[Optional('auto_index')]
    public ?bool $autoIndex;

    /**
     * Additional metadata to associate with the file.
     */
    #[Optional]
    public mixed $metadata;

    /**
     * Multipart part size in bytes (min 5MB). Defaults to 64MB.
     */
    #[Optional]
    public ?int $partSizeBytes;

    /**
     * Optional folder path for hierarchy preservation.
     */
    #[Optional]
    public ?string $path;

    /**
     * `new MultipartInitParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MultipartInitParams::with(contentType: ..., filename: ..., sizeBytes: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MultipartInitParams)
     *   ->withContentType(...)
     *   ->withFilename(...)
     *   ->withSizeBytes(...)
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
        string $contentType,
        string $filename,
        int $sizeBytes,
        ?bool $autoIndex = null,
        mixed $metadata = null,
        ?int $partSizeBytes = null,
        ?string $path = null,
    ): self {
        $self = new self;

        $self['contentType'] = $contentType;
        $self['filename'] = $filename;
        $self['sizeBytes'] = $sizeBytes;

        null !== $autoIndex && $self['autoIndex'] = $autoIndex;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $partSizeBytes && $self['partSizeBytes'] = $partSizeBytes;
        null !== $path && $self['path'] = $path;

        return $self;
    }

    /**
     * MIME type of the file.
     */
    public function withContentType(string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }

    /**
     * Name of the file to upload.
     */
    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }

    /**
     * File size in bytes (required, max 8GB).
     */
    public function withSizeBytes(int $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    /**
     * Whether to automatically process and index the file for search.
     */
    public function withAutoIndex(bool $autoIndex): self
    {
        $self = clone $this;
        $self['autoIndex'] = $autoIndex;

        return $self;
    }

    /**
     * Additional metadata to associate with the file.
     */
    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Multipart part size in bytes (min 5MB). Defaults to 64MB.
     */
    public function withPartSizeBytes(int $partSizeBytes): self
    {
        $self = clone $this;
        $self['partSizeBytes'] = $partSizeBytes;

        return $self;
    }

    /**
     * Optional folder path for hierarchy preservation.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }
}
