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
 *   autoIndex?: bool,
 *   metadata?: mixed,
 *   sizeBytes?: float,
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
     * Estimated file size in bytes for cost calculation.
     */
    #[Optional]
    public ?float $sizeBytes;

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
        ?float $sizeBytes = null,
    ): self {
        $obj = new self;

        $obj['contentType'] = $contentType;
        $obj['filename'] = $filename;

        null !== $autoIndex && $obj['autoIndex'] = $autoIndex;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $sizeBytes && $obj['sizeBytes'] = $sizeBytes;

        return $obj;
    }

    /**
     * MIME type of the file (e.g., application/pdf, image/jpeg).
     */
    public function withContentType(string $contentType): self
    {
        $obj = clone $this;
        $obj['contentType'] = $contentType;

        return $obj;
    }

    /**
     * Name of the file to upload.
     */
    public function withFilename(string $filename): self
    {
        $obj = clone $this;
        $obj['filename'] = $filename;

        return $obj;
    }

    /**
     * Whether to automatically process and index the file for search.
     */
    public function withAutoIndex(bool $autoIndex): self
    {
        $obj = clone $this;
        $obj['autoIndex'] = $autoIndex;

        return $obj;
    }

    /**
     * Additional metadata to associate with the file.
     */
    public function withMetadata(mixed $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * Estimated file size in bytes for cost calculation.
     */
    public function withSizeBytes(float $sizeBytes): self
    {
        $obj = clone $this;
        $obj['sizeBytes'] = $sizeBytes;

        return $obj;
    }
}
