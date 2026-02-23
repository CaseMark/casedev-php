<?php

declare(strict_types=1);

namespace Router\Legal\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type V1GetFullTextResponseShape = array{
 *   author?: string|null,
 *   characterCount?: int|null,
 *   highlights?: list<string>|null,
 *   publishedDate?: string|null,
 *   summary?: string|null,
 *   text?: string|null,
 *   title?: string|null,
 *   url?: string|null,
 * }
 */
final class V1GetFullTextResponse implements BaseModel
{
    /** @use SdkModel<V1GetFullTextResponseShape> */
    use SdkModel;

    /**
     * Author or court.
     */
    #[Optional(nullable: true)]
    public ?string $author;

    /**
     * Total characters in text.
     */
    #[Optional]
    public ?int $characterCount;

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
     * AI-generated summary.
     */
    #[Optional(nullable: true)]
    public ?string $summary;

    /**
     * Full document text.
     */
    #[Optional]
    public ?string $text;

    /**
     * Document title.
     */
    #[Optional]
    public ?string $title;

    /**
     * Document URL.
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
        ?string $author = null,
        ?int $characterCount = null,
        ?array $highlights = null,
        ?string $publishedDate = null,
        ?string $summary = null,
        ?string $text = null,
        ?string $title = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $author && $self['author'] = $author;
        null !== $characterCount && $self['characterCount'] = $characterCount;
        null !== $highlights && $self['highlights'] = $highlights;
        null !== $publishedDate && $self['publishedDate'] = $publishedDate;
        null !== $summary && $self['summary'] = $summary;
        null !== $text && $self['text'] = $text;
        null !== $title && $self['title'] = $title;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Author or court.
     */
    public function withAuthor(?string $author): self
    {
        $self = clone $this;
        $self['author'] = $author;

        return $self;
    }

    /**
     * Total characters in text.
     */
    public function withCharacterCount(int $characterCount): self
    {
        $self = clone $this;
        $self['characterCount'] = $characterCount;

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
     * AI-generated summary.
     */
    public function withSummary(?string $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }

    /**
     * Full document text.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Document title.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Document URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
