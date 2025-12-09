<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Find web pages and documents similar to a given URL. Useful for legal research to discover related case law, statutes, or legal commentary that shares similar themes or content structure.
 *
 * @see Casedev\Services\Search\V1Service::similar()
 *
 * @phpstan-type V1SimilarParamsShape = array{
 *   url: string,
 *   contents?: string,
 *   endCrawlDate?: \DateTimeInterface,
 *   endPublishedDate?: \DateTimeInterface,
 *   excludeDomains?: list<string>,
 *   includeDomains?: list<string>,
 *   includeText?: bool,
 *   numResults?: int,
 *   startCrawlDate?: \DateTimeInterface,
 *   startPublishedDate?: \DateTimeInterface,
 * }
 */
final class V1SimilarParams implements BaseModel
{
    /** @use SdkModel<V1SimilarParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The URL to find similar content for.
     */
    #[Required]
    public string $url;

    /**
     * Additional content to consider for similarity matching.
     */
    #[Optional]
    public ?string $contents;

    /**
     * Only include pages crawled before this date.
     */
    #[Optional]
    public ?\DateTimeInterface $endCrawlDate;

    /**
     * Only include pages published before this date.
     */
    #[Optional]
    public ?\DateTimeInterface $endPublishedDate;

    /**
     * Exclude results from these domains.
     *
     * @var list<string>|null $excludeDomains
     */
    #[Optional(list: 'string')]
    public ?array $excludeDomains;

    /**
     * Only search within these domains.
     *
     * @var list<string>|null $includeDomains
     */
    #[Optional(list: 'string')]
    public ?array $includeDomains;

    /**
     * Whether to include extracted text content in results.
     */
    #[Optional]
    public ?bool $includeText;

    /**
     * Number of similar results to return.
     */
    #[Optional]
    public ?int $numResults;

    /**
     * Only include pages crawled after this date.
     */
    #[Optional]
    public ?\DateTimeInterface $startCrawlDate;

    /**
     * Only include pages published after this date.
     */
    #[Optional]
    public ?\DateTimeInterface $startPublishedDate;

    /**
     * `new V1SimilarParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1SimilarParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1SimilarParams)->withURL(...)
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
     * @param list<string> $excludeDomains
     * @param list<string> $includeDomains
     */
    public static function with(
        string $url,
        ?string $contents = null,
        ?\DateTimeInterface $endCrawlDate = null,
        ?\DateTimeInterface $endPublishedDate = null,
        ?array $excludeDomains = null,
        ?array $includeDomains = null,
        ?bool $includeText = null,
        ?int $numResults = null,
        ?\DateTimeInterface $startCrawlDate = null,
        ?\DateTimeInterface $startPublishedDate = null,
    ): self {
        $obj = new self;

        $obj['url'] = $url;

        null !== $contents && $obj['contents'] = $contents;
        null !== $endCrawlDate && $obj['endCrawlDate'] = $endCrawlDate;
        null !== $endPublishedDate && $obj['endPublishedDate'] = $endPublishedDate;
        null !== $excludeDomains && $obj['excludeDomains'] = $excludeDomains;
        null !== $includeDomains && $obj['includeDomains'] = $includeDomains;
        null !== $includeText && $obj['includeText'] = $includeText;
        null !== $numResults && $obj['numResults'] = $numResults;
        null !== $startCrawlDate && $obj['startCrawlDate'] = $startCrawlDate;
        null !== $startPublishedDate && $obj['startPublishedDate'] = $startPublishedDate;

        return $obj;
    }

    /**
     * The URL to find similar content for.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }

    /**
     * Additional content to consider for similarity matching.
     */
    public function withContents(string $contents): self
    {
        $obj = clone $this;
        $obj['contents'] = $contents;

        return $obj;
    }

    /**
     * Only include pages crawled before this date.
     */
    public function withEndCrawlDate(\DateTimeInterface $endCrawlDate): self
    {
        $obj = clone $this;
        $obj['endCrawlDate'] = $endCrawlDate;

        return $obj;
    }

    /**
     * Only include pages published before this date.
     */
    public function withEndPublishedDate(
        \DateTimeInterface $endPublishedDate
    ): self {
        $obj = clone $this;
        $obj['endPublishedDate'] = $endPublishedDate;

        return $obj;
    }

    /**
     * Exclude results from these domains.
     *
     * @param list<string> $excludeDomains
     */
    public function withExcludeDomains(array $excludeDomains): self
    {
        $obj = clone $this;
        $obj['excludeDomains'] = $excludeDomains;

        return $obj;
    }

    /**
     * Only search within these domains.
     *
     * @param list<string> $includeDomains
     */
    public function withIncludeDomains(array $includeDomains): self
    {
        $obj = clone $this;
        $obj['includeDomains'] = $includeDomains;

        return $obj;
    }

    /**
     * Whether to include extracted text content in results.
     */
    public function withIncludeText(bool $includeText): self
    {
        $obj = clone $this;
        $obj['includeText'] = $includeText;

        return $obj;
    }

    /**
     * Number of similar results to return.
     */
    public function withNumResults(int $numResults): self
    {
        $obj = clone $this;
        $obj['numResults'] = $numResults;

        return $obj;
    }

    /**
     * Only include pages crawled after this date.
     */
    public function withStartCrawlDate(\DateTimeInterface $startCrawlDate): self
    {
        $obj = clone $this;
        $obj['startCrawlDate'] = $startCrawlDate;

        return $obj;
    }

    /**
     * Only include pages published after this date.
     */
    public function withStartPublishedDate(
        \DateTimeInterface $startPublishedDate
    ): self {
        $obj = clone $this;
        $obj['startPublishedDate'] = $startPublishedDate;

        return $obj;
    }
}
