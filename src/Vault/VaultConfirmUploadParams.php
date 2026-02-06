<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Confirm whether a direct-to-S3 vault upload succeeded or failed. This endpoint emits vault.upload.completed or vault.upload.failed events and is idempotent for repeated confirmations.
 *
 * @see Casedev\Services\VaultService::confirmUpload()
 *
 * @phpstan-type VaultConfirmUploadParamsShape = array{
 *   id: string,
 *   sizeBytes?: int|null,
 *   success: bool,
 *   errorCode: string,
 *   errorMessage: string,
 *   etag?: string|null,
 * }
 */
final class VaultConfirmUploadParams implements BaseModel
{
    /** @use SdkModel<VaultConfirmUploadParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Uploaded file size in bytes (required when success=true).
     */
    #[Optional]
    public ?int $sizeBytes;

    #[Required]
    public bool $success;

    /**
     * Client-side error code (required when success=false).
     */
    #[Required]
    public string $errorCode;

    /**
     * Client-side error message (required when success=false).
     */
    #[Required]
    public string $errorMessage;

    /**
     * S3 ETag for the uploaded object (optional if client cannot access ETag header).
     */
    #[Optional]
    public ?string $etag;

    /**
     * `new VaultConfirmUploadParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VaultConfirmUploadParams::with(
     *   id: ..., success: ..., errorCode: ..., errorMessage: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VaultConfirmUploadParams)
     *   ->withID(...)
     *   ->withSuccess(...)
     *   ->withErrorCode(...)
     *   ->withErrorMessage(...)
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
        bool $success,
        string $errorCode,
        string $errorMessage,
        ?int $sizeBytes = null,
        ?string $etag = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['success'] = $success;
        $self['errorCode'] = $errorCode;
        $self['errorMessage'] = $errorMessage;

        null !== $sizeBytes && $self['sizeBytes'] = $sizeBytes;
        null !== $etag && $self['etag'] = $etag;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Uploaded file size in bytes (required when success=true).
     */
    public function withSizeBytes(int $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Client-side error code (required when success=false).
     */
    public function withErrorCode(string $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    /**
     * Client-side error message (required when success=false).
     */
    public function withErrorMessage(string $errorMessage): self
    {
        $self = clone $this;
        $self['errorMessage'] = $errorMessage;

        return $self;
    }

    /**
     * S3 ETag for the uploaded object (optional if client cannot access ETag header).
     */
    public function withEtag(string $etag): self
    {
        $self = clone $this;
        $self['etag'] = $etag;

        return $self;
    }
}
