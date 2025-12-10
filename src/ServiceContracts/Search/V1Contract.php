<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Search;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Search\V1\V1AnswerParams\SearchType;
use Casedev\Search\V1\V1AnswerResponse;
use Casedev\Search\V1\V1ContentsResponse;
use Casedev\Search\V1\V1ResearchParams\Model;
use Casedev\Search\V1\V1ResearchResponse;
use Casedev\Search\V1\V1SearchParams\Type;
use Casedev\Search\V1\V1SearchResponse;
use Casedev\Search\V1\V1SimilarResponse;

interface V1Contract
{
    /**
     * @api
     *
     * @param string $query The question or topic to research and answer
     * @param list<string> $excludeDomains Exclude these domains from search
     * @param list<string> $includeDomains Only search within these domains
     * @param int $maxTokens Maximum tokens for LLM response
     * @param string $model LLM model to use when useCustomLLM is true
     * @param int $numResults Number of search results to consider
     * @param 'auto'|'web'|'news'|'academic'|SearchType $searchType Type of search to perform
     * @param bool $stream Stream the response (only for native provider answers)
     * @param float $temperature LLM temperature for answer generation
     * @param bool $text Include text content in response
     * @param bool $useCustomLlm Use Case.dev LLM for answer generation instead of provider's native answer
     *
     * @throws APIException
     */
    public function answer(
        string $query,
        ?array $excludeDomains = null,
        ?array $includeDomains = null,
        int $maxTokens = 2048,
        string $model = 'gpt-4o',
        int $numResults = 10,
        string|SearchType $searchType = 'auto',
        bool $stream = false,
        float $temperature = 0.3,
        bool $text = true,
        bool $useCustomLlm = false,
        ?RequestOptions $requestOptions = null,
    ): V1AnswerResponse;

    /**
     * @api
     *
     * @param list<string> $urls Array of URLs to scrape and extract content from
     * @param string $context Context to guide content extraction and summarization
     * @param mixed $extras Additional extraction options
     * @param bool $highlights Whether to include content highlights
     * @param bool $livecrawl Whether to perform live crawling for dynamic content
     * @param int $livecrawlTimeout Timeout in seconds for live crawling
     * @param bool $subpages Whether to extract content from linked subpages
     * @param int $subpageTarget Maximum number of subpages to crawl
     * @param bool $summary Whether to generate content summaries
     * @param bool $text Whether to extract text content
     *
     * @throws APIException
     */
    public function contents(
        array $urls,
        ?string $context = null,
        mixed $extras = null,
        bool $highlights = false,
        bool $livecrawl = false,
        int $livecrawlTimeout = 30,
        bool $subpages = false,
        int $subpageTarget = 5,
        bool $summary = false,
        bool $text = true,
        ?RequestOptions $requestOptions = null,
    ): V1ContentsResponse;

    /**
     * @api
     *
     * @param string $instructions Research instructions or query
     * @param 'fast'|'normal'|'pro'|Model $model Research quality level - fast (quick), normal (balanced), pro (comprehensive)
     * @param mixed $outputSchema Optional JSON schema to structure the research output
     * @param string $query Alias for instructions (for convenience)
     *
     * @throws APIException
     */
    public function research(
        string $instructions,
        string|Model $model = 'normal',
        mixed $outputSchema = null,
        ?string $query = null,
        ?RequestOptions $requestOptions = null,
    ): V1ResearchResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier for the research task
     * @param string $events Filter specific event types for streaming
     * @param bool $stream Enable streaming for real-time updates
     *
     * @throws APIException
     */
    public function retrieveResearch(
        string $id,
        ?string $events = null,
        ?bool $stream = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $query Primary search query
     * @param list<string> $additionalQueries Additional related search queries to enhance results
     * @param string $category Category filter for search results
     * @param string $contents Specific content type to search for
     * @param string|\DateTimeInterface $endCrawlDate End date for crawl date filtering
     * @param string|\DateTimeInterface $endPublishedDate End date for published date filtering
     * @param list<string> $excludeDomains Domains to exclude from search results
     * @param list<string> $includeDomains Domains to include in search results
     * @param bool $includeText Whether to include full text content in results
     * @param int $numResults Number of search results to return
     * @param string|\DateTimeInterface $startCrawlDate Start date for crawl date filtering
     * @param string|\DateTimeInterface $startPublishedDate Start date for published date filtering
     * @param 'auto'|'search'|'news'|Type $type Type of search to perform
     * @param string $userLocation Geographic location for localized results
     *
     * @throws APIException
     */
    public function search(
        string $query,
        ?array $additionalQueries = null,
        ?string $category = null,
        ?string $contents = null,
        string|\DateTimeInterface|null $endCrawlDate = null,
        string|\DateTimeInterface|null $endPublishedDate = null,
        ?array $excludeDomains = null,
        ?array $includeDomains = null,
        ?bool $includeText = null,
        int $numResults = 10,
        string|\DateTimeInterface|null $startCrawlDate = null,
        string|\DateTimeInterface|null $startPublishedDate = null,
        string|Type $type = 'auto',
        ?string $userLocation = null,
        ?RequestOptions $requestOptions = null,
    ): V1SearchResponse;

    /**
     * @api
     *
     * @param string $url The URL to find similar content for
     * @param string $contents Additional content to consider for similarity matching
     * @param string|\DateTimeInterface $endCrawlDate Only include pages crawled before this date
     * @param string|\DateTimeInterface $endPublishedDate Only include pages published before this date
     * @param list<string> $excludeDomains Exclude results from these domains
     * @param list<string> $includeDomains Only search within these domains
     * @param bool $includeText Whether to include extracted text content in results
     * @param int $numResults Number of similar results to return
     * @param string|\DateTimeInterface $startCrawlDate Only include pages crawled after this date
     * @param string|\DateTimeInterface $startPublishedDate Only include pages published after this date
     *
     * @throws APIException
     */
    public function similar(
        string $url,
        ?string $contents = null,
        string|\DateTimeInterface|null $endCrawlDate = null,
        string|\DateTimeInterface|null $endPublishedDate = null,
        ?array $excludeDomains = null,
        ?array $includeDomains = null,
        ?bool $includeText = null,
        int $numResults = 10,
        string|\DateTimeInterface|null $startCrawlDate = null,
        string|\DateTimeInterface|null $startPublishedDate = null,
        ?RequestOptions $requestOptions = null,
    ): V1SimilarResponse;
}
