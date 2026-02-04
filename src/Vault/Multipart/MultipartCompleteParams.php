<?php

declare(strict_types=1);

namespace Casedev\Vault\Multipart;

use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\Multipart\MultipartCompleteParams\Part;

/**
 * Complete a multipart upload by providing the list of part numbers and ETags.
 *
 * @see Casedev\Services\Vault\MultipartService::complete()
 *
 * @phpstan-import-type PartShape from \Casedev\Vault\Multipart\MultipartCompleteParams\Part
 *
 * @phpstan-type MultipartCompleteParamsShape = array{
 *   objectID: string,
 *   parts: list<Part|PartShape>,
 *   sizeBytes: int,
 *   uploadID: string,
 * }
 */
final class MultipartCompleteParams implements BaseModel
{
    /** @use SdkModel<MultipartCompleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required('objectId')]
    public string $objectID;

    /** @var list<Part> $parts */
    #[Required(list: Part::class)]
    public array $parts;

    #[Required]
    public int $sizeBytes;

    #[Required('uploadId')]
    public string $uploadID;

    /**
     * `new MultipartCompleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MultipartCompleteParams::with(
     *   objectID: ..., parts: ..., sizeBytes: ..., uploadID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MultipartCompleteParams)
     *   ->withObjectID(...)
     *   ->withParts(...)
     *   ->withSizeBytes(...)
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
        int $sizeBytes,
        string $uploadID
    ): self {
        $self = new self;

        $self['objectID'] = $objectID;
        $self['parts'] = $parts;
        $self['sizeBytes'] = $sizeBytes;
        $self['uploadID'] = $uploadID;

        return $self;
    }

    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * @param list<Part|PartShape> $parts
     */
    public function withParts(array $parts): self
    {
        $self = clone $this;
        $self['parts'] = $parts;

        return $self;
    }

    public function withSizeBytes(int $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    public function withUploadID(string $uploadID): self
    {
        $self = clone $this;
        $self['uploadID'] = $uploadID;

        return $self;
    }
}
