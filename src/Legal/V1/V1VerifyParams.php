<?php

declare(strict_types=1);

namespace Router\Legal\V1;

use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Validates legal citations against authoritative case law sources (CourtListener database of ~10M cases). Returns verification status and case metadata for each citation found in the input text. Accepts either a single citation or a full text block containing multiple citations.
 *
 * @see Router\Services\Legal\V1Service::verify()
 *
 * @phpstan-type V1VerifyParamsShape = array{text: string}
 */
final class V1VerifyParams implements BaseModel
{
    /** @use SdkModel<V1VerifyParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Text containing citations to verify. Can be a single citation (e.g., "531 U.S. 98") or a full document with multiple citations.
     */
    #[Required]
    public string $text;

    /**
     * `new V1VerifyParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1VerifyParams::with(text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1VerifyParams)->withText(...)
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
    public static function with(string $text): self
    {
        $self = new self;

        $self['text'] = $text;

        return $self;
    }

    /**
     * Text containing citations to verify. Can be a single citation (e.g., "531 U.S. 98") or a full document with multiple citations.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
