<?php

declare(strict_types=1);

namespace CaseDev\Vault;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Confirm whether a direct-to-S3 vault upload succeeded or failed. This endpoint emits vault.upload.completed or vault.upload.failed events and is idempotent for repeated confirmations.
 *
 * @see CaseDev\Services\VaultService::confirmUpload()
 *
 * @phpstan-type VaultConfirmUploadParamsShape = array{
 *   id: string,
 *   sizeBytes: int,
 *   success: bool,
 *   etag?: string|null,
 *   errorCode: string,
 *   errorMessage: string,
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
     * Uploaded file size in bytes.
     */
    #[Required]
    public int $sizeBytes;

    /**
     * Whether the upload succeeded.
     */
    #[Required]
    public bool $success;

    /**
     * S3 ETag for the uploaded object (optional if client cannot access ETag header).
     */
    #[Optional]
    public ?string $etag;

    /**
     * Client-side error code.
     */
    #[Required]
    public string $errorCode;

    /**
     * Client-side error message.
     */
    #[Required]
    public string $errorMessage;

    /**
     * `new VaultConfirmUploadParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VaultConfirmUploadParams::with(
     *   id: ..., sizeBytes: ..., success: ..., errorCode: ..., errorMessage: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VaultConfirmUploadParams)
     *   ->withID(...)
     *   ->withSizeBytes(...)
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
        int $sizeBytes,
        bool $success,
        string $errorCode,
        string $errorMessage,
        ?string $etag = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['sizeBytes'] = $sizeBytes;
        $self['success'] = $success;
        $self['errorCode'] = $errorCode;
        $self['errorMessage'] = $errorMessage;

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
     * Uploaded file size in bytes.
     */
    public function withSizeBytes(int $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    /**
     * Whether the upload succeeded.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

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

    /**
     * Client-side error code.
     */
    public function withErrorCode(string $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    /**
     * Client-side error message.
     */
    public function withErrorMessage(string $errorMessage): self
    {
        $self = clone $this;
        $self['errorMessage'] = $errorMessage;

        return $self;
    }
}
