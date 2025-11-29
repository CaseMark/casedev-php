<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Api;
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
    #[Api(list: 'string')]
    public array $urls;

    /**
     * Context to guide content extraction and summarization.
     */
    #[Api(optional: true)]
    public ?string $context;

    /**
     * Additional extraction options.
     */
    #[Api(optional: true)]
    public mixed $extras;

    /**
     * Whether to include content highlights.
     */
    #[Api(optional: true)]
    public ?bool $highlights;

    /**
     * Whether to perform live crawling for dynamic content.
     */
    #[Api(optional: true)]
    public ?bool $livecrawl;

    /**
     * Timeout in seconds for live crawling.
     */
    #[Api(optional: true)]
    public ?int $livecrawlTimeout;

    /**
     * Whether to extract content from linked subpages.
     */
    #[Api(optional: true)]
    public ?bool $subpages;

    /**
     * Maximum number of subpages to crawl.
     */
    #[Api(optional: true)]
    public ?int $subpageTarget;

    /**
     * Whether to generate content summaries.
     */
    #[Api(optional: true)]
    public ?bool $summary;

    /**
     * Whether to extract text content.
     */
    #[Api(optional: true)]
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
        $obj = new self;

        $obj->urls = $urls;

        null !== $context && $obj->context = $context;
        null !== $extras && $obj->extras = $extras;
        null !== $highlights && $obj->highlights = $highlights;
        null !== $livecrawl && $obj->livecrawl = $livecrawl;
        null !== $livecrawlTimeout && $obj->livecrawlTimeout = $livecrawlTimeout;
        null !== $subpages && $obj->subpages = $subpages;
        null !== $subpageTarget && $obj->subpageTarget = $subpageTarget;
        null !== $summary && $obj->summary = $summary;
        null !== $text && $obj->text = $text;

        return $obj;
    }

    /**
     * Array of URLs to scrape and extract content from.
     *
     * @param list<string> $urls
     */
    public function withURLs(array $urls): self
    {
        $obj = clone $this;
        $obj->urls = $urls;

        return $obj;
    }

    /**
     * Context to guide content extraction and summarization.
     */
    public function withContext(string $context): self
    {
        $obj = clone $this;
        $obj->context = $context;

        return $obj;
    }

    /**
     * Additional extraction options.
     */
    public function withExtras(mixed $extras): self
    {
        $obj = clone $this;
        $obj->extras = $extras;

        return $obj;
    }

    /**
     * Whether to include content highlights.
     */
    public function withHighlights(bool $highlights): self
    {
        $obj = clone $this;
        $obj->highlights = $highlights;

        return $obj;
    }

    /**
     * Whether to perform live crawling for dynamic content.
     */
    public function withLivecrawl(bool $livecrawl): self
    {
        $obj = clone $this;
        $obj->livecrawl = $livecrawl;

        return $obj;
    }

    /**
     * Timeout in seconds for live crawling.
     */
    public function withLivecrawlTimeout(int $livecrawlTimeout): self
    {
        $obj = clone $this;
        $obj->livecrawlTimeout = $livecrawlTimeout;

        return $obj;
    }

    /**
     * Whether to extract content from linked subpages.
     */
    public function withSubpages(bool $subpages): self
    {
        $obj = clone $this;
        $obj->subpages = $subpages;

        return $obj;
    }

    /**
     * Maximum number of subpages to crawl.
     */
    public function withSubpageTarget(int $subpageTarget): self
    {
        $obj = clone $this;
        $obj->subpageTarget = $subpageTarget;

        return $obj;
    }

    /**
     * Whether to generate content summaries.
     */
    public function withSummary(bool $summary): self
    {
        $obj = clone $this;
        $obj->summary = $summary;

        return $obj;
    }

    /**
     * Whether to extract text content.
     */
    public function withText(bool $text): self
    {
        $obj = clone $this;
        $obj->text = $text;

        return $obj;
    }
}
