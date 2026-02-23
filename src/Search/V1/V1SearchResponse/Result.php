<?php

declare(strict_types=1);

namespace Router\Search\V1\V1SearchResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResultShape = array{
 *   domain?: string|null,
 *   publishedDate?: \DateTimeInterface|null,
 *   snippet?: string|null,
 *   title?: string|null,
 *   url?: string|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Domain of the source.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Publication date of the content.
     */
    #[Optional]
    public ?\DateTimeInterface $publishedDate;

    /**
     * Brief excerpt from the content.
     */
    #[Optional]
    public ?string $snippet;

    /**
     * Title of the search result.
     */
    #[Optional]
    public ?string $title;

    /**
     * URL of the search result.
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
        ?string $domain = null,
        ?\DateTimeInterface $publishedDate = null,
        ?string $snippet = null,
        ?string $title = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $domain && $self['domain'] = $domain;
        null !== $publishedDate && $self['publishedDate'] = $publishedDate;
        null !== $snippet && $self['snippet'] = $snippet;
        null !== $title && $self['title'] = $title;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Domain of the source.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Publication date of the content.
     */
    public function withPublishedDate(\DateTimeInterface $publishedDate): self
    {
        $self = clone $this;
        $self['publishedDate'] = $publishedDate;

        return $self;
    }

    /**
     * Brief excerpt from the content.
     */
    public function withSnippet(string $snippet): self
    {
        $self = clone $this;
        $self['snippet'] = $snippet;

        return $self;
    }

    /**
     * Title of the search result.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * URL of the search result.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
