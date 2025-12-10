<?php

declare(strict_types=1);

namespace Casedev\Search\V1\V1ContentsResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResultShape = array{
 *   highlights?: list<string>|null,
 *   metadata?: mixed,
 *   summary?: string|null,
 *   text?: string|null,
 *   title?: string|null,
 *   url?: string|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Content highlights if requested.
     *
     * @var list<string>|null $highlights
     */
    #[Optional(list: 'string')]
    public ?array $highlights;

    /**
     * Additional metadata about the content.
     */
    #[Optional]
    public mixed $metadata;

    /**
     * Content summary if requested.
     */
    #[Optional]
    public ?string $summary;

    /**
     * Extracted text content.
     */
    #[Optional]
    public ?string $text;

    /**
     * Page title.
     */
    #[Optional]
    public ?string $title;

    /**
     * Source URL.
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
     * @param list<string> $highlights
     */
    public static function with(
        ?array $highlights = null,
        mixed $metadata = null,
        ?string $summary = null,
        ?string $text = null,
        ?string $title = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $highlights && $self['highlights'] = $highlights;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $summary && $self['summary'] = $summary;
        null !== $text && $self['text'] = $text;
        null !== $title && $self['title'] = $title;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Content highlights if requested.
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
     * Additional metadata about the content.
     */
    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Content summary if requested.
     */
    public function withSummary(string $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }

    /**
     * Extracted text content.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Page title.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Source URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
