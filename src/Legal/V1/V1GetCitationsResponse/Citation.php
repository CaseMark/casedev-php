<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1GetCitationsResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1GetCitationsResponse\Citation\Components;
use CaseDev\Legal\V1\V1GetCitationsResponse\Citation\Span;

/**
 * @phpstan-import-type ComponentsShape from \CaseDev\Legal\V1\V1GetCitationsResponse\Citation\Components
 * @phpstan-import-type SpanShape from \CaseDev\Legal\V1\V1GetCitationsResponse\Citation\Span
 *
 * @phpstan-type CitationShape = array{
 *   components?: null|Components|ComponentsShape,
 *   found?: bool|null,
 *   normalized?: string|null,
 *   original?: string|null,
 *   span?: null|Span|SpanShape,
 * }
 */
final class Citation implements BaseModel
{
    /** @use SdkModel<CitationShape> */
    use SdkModel;

    /**
     * Structured Bluebook components. Null if citation format is not recognized.
     */
    #[Optional(nullable: true)]
    public ?Components $components;

    /**
     * Whether citation was found in CourtListener database.
     */
    #[Optional]
    public ?bool $found;

    /**
     * Normalized citation string.
     */
    #[Optional]
    public ?string $normalized;

    /**
     * Original citation as found in text.
     */
    #[Optional]
    public ?string $original;

    #[Optional]
    public ?Span $span;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Components|ComponentsShape|null $components
     * @param Span|SpanShape|null $span
     */
    public static function with(
        Components|array|null $components = null,
        ?bool $found = null,
        ?string $normalized = null,
        ?string $original = null,
        Span|array|null $span = null,
    ): self {
        $self = new self;

        null !== $components && $self['components'] = $components;
        null !== $found && $self['found'] = $found;
        null !== $normalized && $self['normalized'] = $normalized;
        null !== $original && $self['original'] = $original;
        null !== $span && $self['span'] = $span;

        return $self;
    }

    /**
     * Structured Bluebook components. Null if citation format is not recognized.
     *
     * @param Components|ComponentsShape|null $components
     */
    public function withComponents(Components|array|null $components): self
    {
        $self = clone $this;
        $self['components'] = $components;

        return $self;
    }

    /**
     * Whether citation was found in CourtListener database.
     */
    public function withFound(bool $found): self
    {
        $self = clone $this;
        $self['found'] = $found;

        return $self;
    }

    /**
     * Normalized citation string.
     */
    public function withNormalized(string $normalized): self
    {
        $self = clone $this;
        $self['normalized'] = $normalized;

        return $self;
    }

    /**
     * Original citation as found in text.
     */
    public function withOriginal(string $original): self
    {
        $self = clone $this;
        $self['original'] = $original;

        return $self;
    }

    /**
     * @param Span|SpanShape $span
     */
    public function withSpan(Span|array $span): self
    {
        $self = clone $this;
        $self['span'] = $span;

        return $self;
    }
}
