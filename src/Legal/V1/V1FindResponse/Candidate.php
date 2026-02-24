<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1FindResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type CandidateShape = array{
 *   snippet?: string|null,
 *   source?: string|null,
 *   title?: string|null,
 *   url?: string|null,
 * }
 */
final class Candidate implements BaseModel
{
    /** @use SdkModel<CandidateShape> */
    use SdkModel;

    /**
     * Text excerpt from the document.
     */
    #[Optional]
    public ?string $snippet;

    /**
     * Domain of the source.
     */
    #[Optional]
    public ?string $source;

    /**
     * Title of the document.
     */
    #[Optional]
    public ?string $title;

    /**
     * URL of the legal source.
     */
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
        ?string $snippet = null,
        ?string $source = null,
        ?string $title = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $snippet && $self['snippet'] = $snippet;
        null !== $source && $self['source'] = $source;
        null !== $title && $self['title'] = $title;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Text excerpt from the document.
     */
    public function withSnippet(string $snippet): self
    {
        $self = clone $this;
        $self['snippet'] = $snippet;

        return $self;
    }

    /**
     * Domain of the source.
     */
    public function withSource(string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * Title of the document.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * URL of the legal source.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
