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
        $obj = new self;

        null !== $highlights && $obj['highlights'] = $highlights;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $summary && $obj['summary'] = $summary;
        null !== $text && $obj['text'] = $text;
        null !== $title && $obj['title'] = $title;
        null !== $url && $obj['url'] = $url;

        return $obj;
    }

    /**
     * Content highlights if requested.
     *
     * @param list<string> $highlights
     */
    public function withHighlights(array $highlights): self
    {
        $obj = clone $this;
        $obj['highlights'] = $highlights;

        return $obj;
    }

    /**
     * Additional metadata about the content.
     */
    public function withMetadata(mixed $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * Content summary if requested.
     */
    public function withSummary(string $summary): self
    {
        $obj = clone $this;
        $obj['summary'] = $summary;

        return $obj;
    }

    /**
     * Extracted text content.
     */
    public function withText(string $text): self
    {
        $obj = clone $this;
        $obj['text'] = $text;

        return $obj;
    }

    /**
     * Page title.
     */
    public function withTitle(string $title): self
    {
        $obj = clone $this;
        $obj['title'] = $title;

        return $obj;
    }

    /**
     * Source URL.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }
}
