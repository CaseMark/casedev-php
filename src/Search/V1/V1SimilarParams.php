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
 *   endCrawlDate?: string,
 *   endPublishedDate?: string,
 *   excludeDomains?: list<string>,
 *   includeDomains?: list<string>,
 *   includeText?: bool,
 *   numResults?: int,
 *   startCrawlDate?: string,
 *   startPublishedDate?: string,
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
    public ?string $endCrawlDate;

    /**
     * Only include pages published before this date.
     */
    #[Optional]
    public ?string $endPublishedDate;

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
    public ?string $startCrawlDate;

    /**
     * Only include pages published after this date.
     */
    #[Optional]
    public ?string $startPublishedDate;

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
        ?string $endCrawlDate = null,
        ?string $endPublishedDate = null,
        ?array $excludeDomains = null,
        ?array $includeDomains = null,
        ?bool $includeText = null,
        ?int $numResults = null,
        ?string $startCrawlDate = null,
        ?string $startPublishedDate = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $contents && $self['contents'] = $contents;
        null !== $endCrawlDate && $self['endCrawlDate'] = $endCrawlDate;
        null !== $endPublishedDate && $self['endPublishedDate'] = $endPublishedDate;
        null !== $excludeDomains && $self['excludeDomains'] = $excludeDomains;
        null !== $includeDomains && $self['includeDomains'] = $includeDomains;
        null !== $includeText && $self['includeText'] = $includeText;
        null !== $numResults && $self['numResults'] = $numResults;
        null !== $startCrawlDate && $self['startCrawlDate'] = $startCrawlDate;
        null !== $startPublishedDate && $self['startPublishedDate'] = $startPublishedDate;

        return $self;
    }

    /**
     * The URL to find similar content for.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Additional content to consider for similarity matching.
     */
    public function withContents(string $contents): self
    {
        $self = clone $this;
        $self['contents'] = $contents;

        return $self;
    }

    /**
     * Only include pages crawled before this date.
     */
    public function withEndCrawlDate(string $endCrawlDate): self
    {
        $self = clone $this;
        $self['endCrawlDate'] = $endCrawlDate;

        return $self;
    }

    /**
     * Only include pages published before this date.
     */
    public function withEndPublishedDate(string $endPublishedDate): self
    {
        $self = clone $this;
        $self['endPublishedDate'] = $endPublishedDate;

        return $self;
    }

    /**
     * Exclude results from these domains.
     *
     * @param list<string> $excludeDomains
     */
    public function withExcludeDomains(array $excludeDomains): self
    {
        $self = clone $this;
        $self['excludeDomains'] = $excludeDomains;

        return $self;
    }

    /**
     * Only search within these domains.
     *
     * @param list<string> $includeDomains
     */
    public function withIncludeDomains(array $includeDomains): self
    {
        $self = clone $this;
        $self['includeDomains'] = $includeDomains;

        return $self;
    }

    /**
     * Whether to include extracted text content in results.
     */
    public function withIncludeText(bool $includeText): self
    {
        $self = clone $this;
        $self['includeText'] = $includeText;

        return $self;
    }

    /**
     * Number of similar results to return.
     */
    public function withNumResults(int $numResults): self
    {
        $self = clone $this;
        $self['numResults'] = $numResults;

        return $self;
    }

    /**
     * Only include pages crawled after this date.
     */
    public function withStartCrawlDate(string $startCrawlDate): self
    {
        $self = clone $this;
        $self['startCrawlDate'] = $startCrawlDate;

        return $self;
    }

    /**
     * Only include pages published after this date.
     */
    public function withStartPublishedDate(string $startPublishedDate): self
    {
        $self = clone $this;
        $self['startPublishedDate'] = $startPublishedDate;

        return $self;
    }
}
