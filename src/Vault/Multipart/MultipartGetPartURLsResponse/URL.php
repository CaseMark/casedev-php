<?php

declare(strict_types=1);

namespace Casedev\Vault\Multipart\MultipartGetPartURLsResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type URLShape = array{partNumber?: int|null, url?: string|null}
 */
final class URL implements BaseModel
{
    /** @use SdkModel<URLShape> */
    use SdkModel;

    #[Optional]
    public ?int $partNumber;

    #[Optional]
    public ?string $url;

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
        ?int $partNumber = null,
        ?string $url = null
    ): self {
        $self = new self;

        null !== $partNumber && $self['partNumber'] = $partNumber;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withPartNumber(int $partNumber): self
    {
        $self = clone $this;
        $self['partNumber'] = $partNumber;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
