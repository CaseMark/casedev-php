<?php

declare(strict_types=1);

namespace Router\Legal\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Retrieve the full text content of a legal document. Use after verifying the source with legal.verify(). Returns complete text with optional highlights and AI summary.
 *
 * @see Router\Services\Legal\V1Service::getFullText()
 *
 * @phpstan-type V1GetFullTextParamsShape = array{
 *   url: string,
 *   highlightQuery?: string|null,
 *   maxCharacters?: int|null,
 *   summaryQuery?: string|null,
 * }
 */
final class V1GetFullTextParams implements BaseModel
{
    /** @use SdkModel<V1GetFullTextParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * URL of the verified legal document.
     */
    #[Required]
    public string $url;

    /**
     * Optional query to extract relevant highlights (e.g., "What is the holding?").
     */
    #[Optional]
    public ?string $highlightQuery;

    /**
     * Maximum characters to return (default: 10000, max: 50000).
     */
    #[Optional]
    public ?int $maxCharacters;

    /**
     * Optional query for generating a summary (e.g., "Summarize the key ruling").
     */
    #[Optional]
    public ?string $summaryQuery;

    /**
     * `new V1GetFullTextParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1GetFullTextParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1GetFullTextParams)->withURL(...)
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
        string $url,
        ?string $highlightQuery = null,
        ?int $maxCharacters = null,
        ?string $summaryQuery = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $highlightQuery && $self['highlightQuery'] = $highlightQuery;
        null !== $maxCharacters && $self['maxCharacters'] = $maxCharacters;
        null !== $summaryQuery && $self['summaryQuery'] = $summaryQuery;

        return $self;
    }

    /**
     * URL of the verified legal document.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Optional query to extract relevant highlights (e.g., "What is the holding?").
     */
    public function withHighlightQuery(string $highlightQuery): self
    {
        $self = clone $this;
        $self['highlightQuery'] = $highlightQuery;

        return $self;
    }

    /**
     * Maximum characters to return (default: 10000, max: 50000).
     */
    public function withMaxCharacters(int $maxCharacters): self
    {
        $self = clone $this;
        $self['maxCharacters'] = $maxCharacters;

        return $self;
    }

    /**
     * Optional query for generating a summary (e.g., "Summarize the key ruling").
     */
    public function withSummaryQuery(string $summaryQuery): self
    {
        $self = clone $this;
        $self['summaryQuery'] = $summaryQuery;

        return $self;
    }
}
