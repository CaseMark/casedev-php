<?php

declare(strict_types=1);

namespace Router\Legal\V1;

use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Parses legal citations from text and returns structured Bluebook components (case name, reporter, volume, page, year, court). Accepts either a single citation or a full text block.
 *
 * @see Router\Services\Legal\V1Service::getCitations()
 *
 * @phpstan-type V1GetCitationsParamsShape = array{text: string}
 */
final class V1GetCitationsParams implements BaseModel
{
    /** @use SdkModel<V1GetCitationsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Text containing citations to extract. Can be a single citation (e.g., "531 U.S. 98") or a full document with multiple citations.
     */
    #[Required]
    public string $text;

    /**
     * `new V1GetCitationsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1GetCitationsParams::with(text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1GetCitationsParams)->withText(...)
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
     * Text containing citations to extract. Can be a single citation (e.g., "531 U.S. 98") or a full document with multiple citations.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
