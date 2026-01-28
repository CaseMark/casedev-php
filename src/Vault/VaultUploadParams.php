<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Generate a presigned URL for uploading files directly to a vault's S3 storage. This endpoint creates a temporary upload URL that allows secure file uploads without exposing credentials. Files can be automatically indexed for semantic search or stored for manual processing.
 *
 * @see Casedev\Services\VaultService::upload()
 *
 * @phpstan-type VaultUploadParamsShape = array{
 *   contentType: string,
 *   filename: string,
 *   autoIndex?: bool|null,
 *   metadata?: mixed,
 *   path?: string|null,
 *   sizeBytes?: int|null,
 * }
 */
final class VaultUploadParams implements BaseModel
{
    /** @use SdkModel<VaultUploadParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * MIME type of the file (e.g., application/pdf, image/jpeg).
     */
    #[Required]
    public string $contentType;

    /**
     * Name of the file to upload.
     */
    #[Required]
    public string $filename;

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
     * Optional folder path for hierarchy preservation. Allows integrations to maintain source folder structure from systems like NetDocs, Clio, or Smokeball. Example: '/Discovery/Depositions/2024'.
     */
    #[Optional]
    public ?string $path;

    /**
     * File size in bytes (optional, max 500MB). When provided, enforces exact file size at S3 level.
     */
    #[Optional]
    public ?int $sizeBytes;

    /**
     * `new VaultUploadParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VaultUploadParams::with(contentType: ..., filename: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VaultUploadParams)->withContentType(...)->withFilename(...)
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
        ?bool $autoIndex = null,
        mixed $metadata = null,
        ?string $path = null,
        ?int $sizeBytes = null,
    ): self {
        $self = new self;

        $self['contentType'] = $contentType;
        $self['filename'] = $filename;

        null !== $autoIndex && $self['autoIndex'] = $autoIndex;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $path && $self['path'] = $path;
        null !== $sizeBytes && $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    /**
     * MIME type of the file (e.g., application/pdf, image/jpeg).
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
     * Optional folder path for hierarchy preservation. Allows integrations to maintain source folder structure from systems like NetDocs, Clio, or Smokeball. Example: '/Discovery/Depositions/2024'.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * File size in bytes (optional, max 500MB). When provided, enforces exact file size at S3 level.
     */
    public function withSizeBytes(int $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }
}
