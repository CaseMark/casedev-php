<?php

declare(strict_types=1);

namespace Router\Legal\V1;

use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Extract all legal citations and references from a document URL. Returns structured citation data including case citations, statute references, and regulatory citations.
 *
 * @see Router\Services\Legal\V1Service::getCitationsFromURL()
 *
 * @phpstan-type V1GetCitationsFromURLParamsShape = array{url: string}
 */
final class V1GetCitationsFromURLParams implements BaseModel
{
    /** @use SdkModel<V1GetCitationsFromURLParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * URL of the legal document to extract citations from.
     */
    #[Required]
    public string $url;

    /**
     * `new V1GetCitationsFromURLParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1GetCitationsFromURLParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1GetCitationsFromURLParams)->withURL(...)
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
    public static function with(string $url): self
    {
        $self = new self;

        $self['url'] = $url;

        return $self;
    }

    /**
     * URL of the legal document to extract citations from.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
