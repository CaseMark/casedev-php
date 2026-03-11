<?php

declare(strict_types=1);

namespace CaseDev\Vault\Multipart;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\Multipart\MultipartGetPartURLsParams\Part;

/**
 * Generate presigned URLs for individual multipart upload parts (live).
 *
 * @see CaseDev\Services\Vault\MultipartService::getPartURLs()
 *
 * @phpstan-import-type PartShape from \CaseDev\Vault\Multipart\MultipartGetPartURLsParams\Part
 *
 * @phpstan-type MultipartGetPartURLsParamsShape = array{
 *   objectID: string, parts: list<Part|PartShape>, uploadID: string
 * }
 */
final class MultipartGetPartURLsParams implements BaseModel
{
    /** @use SdkModel<MultipartGetPartURLsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Vault object ID associated with the multipart upload.
     */
    #[Required('objectId')]
    public string $objectID;

    /**
     * Multipart parts that need presigned upload URLs.
     *
     * @var list<Part> $parts
     */
    #[Required(list: Part::class)]
    public array $parts;

    /**
     * Multipart upload ID returned when the upload was initialized.
     */
    #[Required('uploadId')]
    public string $uploadID;

    /**
     * `new MultipartGetPartURLsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MultipartGetPartURLsParams::with(objectID: ..., parts: ..., uploadID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MultipartGetPartURLsParams)
     *   ->withObjectID(...)
     *   ->withParts(...)
     *   ->withUploadID(...)
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
     * @param list<Part|PartShape> $parts
     */
    public static function with(
        string $objectID,
        array $parts,
        string $uploadID
    ): self {
        $self = new self;

        $self['objectID'] = $objectID;
        $self['parts'] = $parts;
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
     * Multipart parts that need presigned upload URLs.
     *
     * @param list<Part|PartShape> $parts
     */
    public function withParts(array $parts): self
    {
        $self = clone $this;
        $self['parts'] = $parts;

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
