<?php

declare(strict_types=1);

namespace CaseDev\Vault\Multipart;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Abort a multipart upload and discard uploaded parts (live).
 *
 * @see CaseDev\Services\Vault\MultipartService::abort()
 *
 * @phpstan-type MultipartAbortParamsShape = array{
 *   objectID: string, uploadID: string
 * }
 */
final class MultipartAbortParams implements BaseModel
{
    /** @use SdkModel<MultipartAbortParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Vault object ID associated with the multipart upload.
     */
    #[Required('objectId')]
    public string $objectID;

    /**
     * Multipart upload ID returned when the upload was initialized.
     */
    #[Required('uploadId')]
    public string $uploadID;

    /**
     * `new MultipartAbortParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MultipartAbortParams::with(objectID: ..., uploadID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MultipartAbortParams)->withObjectID(...)->withUploadID(...)
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
    public static function with(string $objectID, string $uploadID): self
    {
        $self = new self;

        $self['objectID'] = $objectID;
        $self['uploadID'] = $uploadID;

        return $self;
    }

    /**
     * Vault object ID associated with the multipart upload.
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * Multipart upload ID returned when the upload was initialized.
     */
    public function withUploadID(string $uploadID): self
    {
        $self = clone $this;
        $self['uploadID'] = $uploadID;

        return $self;
    }
}
