<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1ResearchResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type CandidateShape = array{
 *   highlights?: list<string>|null,
 *   publishedDate?: string|null,
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
     * Highlighted relevant passages.
     *
     * @var list<string>|null $highlights
     */
    #[Optional(list: 'string')]
    public ?array $highlights;

    /**
     * Publication date.
     */
    #[Optional(nullable: true)]
    public ?string $publishedDate;

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
     *
     * @param list<string>|null $highlights
     */
    public static function with(
        ?array $highlights = null,
        ?string $publishedDate = null,
        ?string $snippet = null,
        ?string $source = null,
        ?string $title = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $highlights && $self['highlights'] = $highlights;
        null !== $publishedDate && $self['publishedDate'] = $publishedDate;
        null !== $snippet && $self['snippet'] = $snippet;
        null !== $source && $self['source'] = $source;
        null !== $title && $self['title'] = $title;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Highlighted relevant passages.
     *
     * @param list<string> $highlights
     */
    public function withHighlights(array $highlights): self
    {
        $self = clone $this;
        $self['highlights'] = $highlights;

        return $self;
    }

    /**
     * Publication date.
     */
    public function withPublishedDate(?string $publishedDate): self
    {
        $self = clone $this;
        $self['publishedDate'] = $publishedDate;

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
