<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Search\V1\V1SearchParams\Type;

/**
 * Executes intelligent web search queries with advanced filtering and customization options. Ideal for legal research, case law discovery, and gathering supporting documentation for litigation or compliance matters.
 *
 * @see Casedev\Services\Search\V1Service::search()
 *
 * @phpstan-type V1SearchParamsShape = array{
 *   query: string,
 *   additionalQueries?: list<string>,
 *   category?: string,
 *   contents?: string,
 *   endCrawlDate?: \DateTimeInterface,
 *   endPublishedDate?: \DateTimeInterface,
 *   excludeDomains?: list<string>,
 *   includeDomains?: list<string>,
 *   includeText?: bool,
 *   numResults?: int,
 *   startCrawlDate?: \DateTimeInterface,
 *   startPublishedDate?: \DateTimeInterface,
 *   type?: Type|value-of<Type>,
 *   userLocation?: string,
 * }
 */
final class V1SearchParams implements BaseModel
{
    /** @use SdkModel<V1SearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Primary search query.
     */
    #[Required]
    public string $query;

    /**
     * Additional related search queries to enhance results.
     *
     * @var list<string>|null $additionalQueries
     */
    #[Optional(list: 'string')]
    public ?array $additionalQueries;

    /**
     * Category filter for search results.
     */
    #[Optional]
    public ?string $category;

    /**
     * Specific content type to search for.
     */
    #[Optional]
    public ?string $contents;

    /**
     * End date for crawl date filtering.
     */
    #[Optional]
    public ?\DateTimeInterface $endCrawlDate;

    /**
     * End date for published date filtering.
     */
    #[Optional]
    public ?\DateTimeInterface $endPublishedDate;

    /**
     * Domains to exclude from search results.
     *
     * @var list<string>|null $excludeDomains
     */
    #[Optional(list: 'string')]
    public ?array $excludeDomains;

    /**
     * Domains to include in search results.
     *
     * @var list<string>|null $includeDomains
     */
    #[Optional(list: 'string')]
    public ?array $includeDomains;

    /**
     * Whether to include full text content in results.
     */
    #[Optional]
    public ?bool $includeText;

    /**
     * Number of search results to return.
     */
    #[Optional]
    public ?int $numResults;

    /**
     * Start date for crawl date filtering.
     */
    #[Optional]
    public ?\DateTimeInterface $startCrawlDate;

    /**
     * Start date for published date filtering.
     */
    #[Optional]
    public ?\DateTimeInterface $startPublishedDate;

    /**
     * Type of search to perform.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * Geographic location for localized results.
     */
    #[Optional]
    public ?string $userLocation;

    /**
     * `new V1SearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1SearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1SearchParams)->withQuery(...)
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
     * @param list<string> $additionalQueries
     * @param list<string> $excludeDomains
     * @param list<string> $includeDomains
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $query,
        ?array $additionalQueries = null,
        ?string $category = null,
        ?string $contents = null,
        ?\DateTimeInterface $endCrawlDate = null,
        ?\DateTimeInterface $endPublishedDate = null,
        ?array $excludeDomains = null,
        ?array $includeDomains = null,
        ?bool $includeText = null,
        ?int $numResults = null,
        ?\DateTimeInterface $startCrawlDate = null,
        ?\DateTimeInterface $startPublishedDate = null,
        Type|string|null $type = null,
        ?string $userLocation = null,
    ): self {
        $obj = new self;

        $obj['query'] = $query;

        null !== $additionalQueries && $obj['additionalQueries'] = $additionalQueries;
        null !== $category && $obj['category'] = $category;
        null !== $contents && $obj['contents'] = $contents;
        null !== $endCrawlDate && $obj['endCrawlDate'] = $endCrawlDate;
        null !== $endPublishedDate && $obj['endPublishedDate'] = $endPublishedDate;
        null !== $excludeDomains && $obj['excludeDomains'] = $excludeDomains;
        null !== $includeDomains && $obj['includeDomains'] = $includeDomains;
        null !== $includeText && $obj['includeText'] = $includeText;
        null !== $numResults && $obj['numResults'] = $numResults;
        null !== $startCrawlDate && $obj['startCrawlDate'] = $startCrawlDate;
        null !== $startPublishedDate && $obj['startPublishedDate'] = $startPublishedDate;
        null !== $type && $obj['type'] = $type;
        null !== $userLocation && $obj['userLocation'] = $userLocation;

        return $obj;
    }

    /**
     * Primary search query.
     */
    public function withQuery(string $query): self
    {
        $obj = clone $this;
        $obj['query'] = $query;

        return $obj;
    }

    /**
     * Additional related search queries to enhance results.
     *
     * @param list<string> $additionalQueries
     */
    public function withAdditionalQueries(array $additionalQueries): self
    {
        $obj = clone $this;
        $obj['additionalQueries'] = $additionalQueries;

        return $obj;
    }

    /**
     * Category filter for search results.
     */
    public function withCategory(string $category): self
    {
        $obj = clone $this;
        $obj['category'] = $category;

        return $obj;
    }

    /**
     * Specific content type to search for.
     */
    public function withContents(string $contents): self
    {
        $obj = clone $this;
        $obj['contents'] = $contents;

        return $obj;
    }

    /**
     * End date for crawl date filtering.
     */
    public function withEndCrawlDate(\DateTimeInterface $endCrawlDate): self
    {
        $obj = clone $this;
        $obj['endCrawlDate'] = $endCrawlDate;

        return $obj;
    }

    /**
     * End date for published date filtering.
     */
    public function withEndPublishedDate(
        \DateTimeInterface $endPublishedDate
    ): self {
        $obj = clone $this;
        $obj['endPublishedDate'] = $endPublishedDate;

        return $obj;
    }

    /**
     * Domains to exclude from search results.
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
     * Domains to include in search results.
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
     * Whether to include full text content in results.
     */
    public function withIncludeText(bool $includeText): self
    {
        $obj = clone $this;
        $obj['includeText'] = $includeText;

        return $obj;
    }

    /**
     * Number of search results to return.
     */
    public function withNumResults(int $numResults): self
    {
        $obj = clone $this;
        $obj['numResults'] = $numResults;

        return $obj;
    }

    /**
     * Start date for crawl date filtering.
     */
    public function withStartCrawlDate(\DateTimeInterface $startCrawlDate): self
    {
        $obj = clone $this;
        $obj['startCrawlDate'] = $startCrawlDate;

        return $obj;
    }

    /**
     * Start date for published date filtering.
     */
    public function withStartPublishedDate(
        \DateTimeInterface $startPublishedDate
    ): self {
        $obj = clone $this;
        $obj['startPublishedDate'] = $startPublishedDate;

        return $obj;
    }

    /**
     * Type of search to perform.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * Geographic location for localized results.
     */
    public function withUserLocation(string $userLocation): self
    {
        $obj = clone $this;
        $obj['userLocation'] = $userLocation;

        return $obj;
    }
}
