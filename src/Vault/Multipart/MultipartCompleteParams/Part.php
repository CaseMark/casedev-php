<?php

declare(strict_types=1);

namespace Casedev\Vault\Multipart\MultipartCompleteParams;

use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type PartShape = array{etag: string, partNumber: int}
 */
final class Part implements BaseModel
{
    /** @use SdkModel<PartShape> */
    use SdkModel;

    #[Required]
    public string $etag;

    #[Required]
    public int $partNumber;

    /**
     * `new Part()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Part::with(etag: ..., partNumber: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Part)->withEtag(...)->withPartNumber(...)
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
    public static function with(string $etag, int $partNumber): self
    {
        $self = new self;

        $self['etag'] = $etag;
        $self['partNumber'] = $partNumber;

        return $self;
    }

    public function withEtag(string $etag): self
    {
        $self = clone $this;
        $self['etag'] = $etag;

        return $self;
    }

    public function withPartNumber(int $partNumber): self
    {
        $self = clone $this;
        $self['partNumber'] = $partNumber;

        return $self;
    }
}
