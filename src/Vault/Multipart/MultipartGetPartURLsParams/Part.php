<?php

declare(strict_types=1);

namespace CaseDev\Vault\Multipart\MultipartGetPartURLsParams;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type PartShape = array{partNumber: int, sizeBytes: int}
 */
final class Part implements BaseModel
{
    /** @use SdkModel<PartShape> */
    use SdkModel;

    #[Required]
    public int $partNumber;

    /**
     * Part size in bytes (min 5MB except final part, max 5GB).
     */
    #[Required]
    public int $sizeBytes;

    /**
     * `new Part()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Part::with(partNumber: ..., sizeBytes: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Part)->withPartNumber(...)->withSizeBytes(...)
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
    public static function with(int $partNumber, int $sizeBytes): self
    {
        $self = new self;

        $self['partNumber'] = $partNumber;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    public function withPartNumber(int $partNumber): self
    {
        $self = clone $this;
        $self['partNumber'] = $partNumber;

        return $self;
    }

    /**
     * Part size in bytes (min 5MB except final part, max 5GB).
     */
    public function withSizeBytes(int $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }
}
