<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Scrapes and extracts text content from web pages, PDFs, and documents. Useful for legal research, evidence collection, and document analysis. Supports live crawling, subpage extraction, and content summarization.
 *
 * @see Casedev\Services\Search\V1Service::contents()
 *
 * @phpstan-type V1ContentsParamsShape = array{
 *   urls: list<string>,
 *   context?: string,
 *   extras?: mixed,
 *   highlights?: bool,
 *   livecrawl?: bool,
 *   livecrawlTimeout?: int,
 *   subpages?: bool,
 *   subpageTarget?: int,
 *   summary?: bool,
 *   text?: bool,
 * }
 */
final class V1ContentsParams implements BaseModel
{
    /** @use SdkModel<V1ContentsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Array of URLs to scrape and extract content from.
     *
     * @var list<string> $urls
     */
    #[Required(list: 'string')]
    public array $urls;

    /**
     * Context to guide content extraction and summarization.
     */
    #[Optional]
    public ?string $context;

    /**
     * Additional extraction options.
     */
    #[Optional]
    public mixed $extras;

    /**
     * Whether to include content highlights.
     */
    #[Optional]
    public ?bool $highlights;

    /**
     * Whether to perform live crawling for dynamic content.
     */
    #[Optional]
    public ?bool $livecrawl;

    /**
     * Timeout in seconds for live crawling.
     */
    #[Optional]
    public ?int $livecrawlTimeout;

    /**
     * Whether to extract content from linked subpages.
     */
    #[Optional]
    public ?bool $subpages;

    /**
     * Maximum number of subpages to crawl.
     */
    #[Optional]
    public ?int $subpageTarget;

    /**
     * Whether to generate content summaries.
     */
    #[Optional]
    public ?bool $summary;

    /**
     * Whether to extract text content.
     */
    #[Optional]
    public ?bool $text;

    /**
     * `new V1ContentsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1ContentsParams::with(urls: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1ContentsParams)->withURLs(...)
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
     *
     * @param list<string> $urls
     */
    public static function with(
        array $urls,
        ?string $context = null,
        mixed $extras = null,
        ?bool $highlights = null,
        ?bool $livecrawl = null,
        ?int $livecrawlTimeout = null,
        ?bool $subpages = null,
        ?int $subpageTarget = null,
        ?bool $summary = null,
        ?bool $text = null,
    ): self {
        $self = new self;

        $self['urls'] = $urls;

        null !== $context && $self['context'] = $context;
        null !== $extras && $self['extras'] = $extras;
        null !== $highlights && $self['highlights'] = $highlights;
        null !== $livecrawl && $self['livecrawl'] = $livecrawl;
        null !== $livecrawlTimeout && $self['livecrawlTimeout'] = $livecrawlTimeout;
        null !== $subpages && $self['subpages'] = $subpages;
        null !== $subpageTarget && $self['subpageTarget'] = $subpageTarget;
        null !== $summary && $self['summary'] = $summary;
        null !== $text && $self['text'] = $text;

        return $self;
    }

    /**
     * Array of URLs to scrape and extract content from.
     *
     * @param list<string> $urls
     */
    public function withURLs(array $urls): self
    {
        $self = clone $this;
        $self['urls'] = $urls;

        return $self;
    }

    /**
     * Context to guide content extraction and summarization.
     */
    public function withContext(string $context): self
    {
        $self = clone $this;
        $self['context'] = $context;

        return $self;
    }

    /**
     * Additional extraction options.
     */
    public function withExtras(mixed $extras): self
    {
        $self = clone $this;
        $self['extras'] = $extras;

        return $self;
    }

    /**
     * Whether to include content highlights.
     */
    public function withHighlights(bool $highlights): self
    {
        $self = clone $this;
        $self['highlights'] = $highlights;

        return $self;
    }

    /**
     * Whether to perform live crawling for dynamic content.
     */
    public function withLivecrawl(bool $livecrawl): self
    {
        $self = clone $this;
        $self['livecrawl'] = $livecrawl;

        return $self;
    }

    /**
     * Timeout in seconds for live crawling.
     */
    public function withLivecrawlTimeout(int $livecrawlTimeout): self
    {
        $self = clone $this;
        $self['livecrawlTimeout'] = $livecrawlTimeout;

        return $self;
    }

    /**
     * Whether to extract content from linked subpages.
     */
    public function withSubpages(bool $subpages): self
    {
        $self = clone $this;
        $self['subpages'] = $subpages;

        return $self;
    }

    /**
     * Maximum number of subpages to crawl.
     */
    public function withSubpageTarget(int $subpageTarget): self
    {
        $self = clone $this;
        $self['subpageTarget'] = $subpageTarget;

        return $self;
    }

    /**
     * Whether to generate content summaries.
     */
    public function withSummary(bool $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }

    /**
     * Whether to extract text content.
     */
    public function withText(bool $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
