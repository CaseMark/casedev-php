<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Search\V1\V1AnswerParams\SearchType;

/**
 * Generate comprehensive answers to questions using web search results. Supports two modes: native provider answers or custom LLM-powered answers using Case.dev's AI gateway. Perfect for legal research, fact-checking, and gathering supporting evidence for cases.
 *
 * @see Casedev\Services\Search\V1Service::answer()
 *
 * @phpstan-type V1AnswerParamsShape = array{
 *   query: string,
 *   excludeDomains?: list<string>,
 *   includeDomains?: list<string>,
 *   maxTokens?: int,
 *   model?: string,
 *   numResults?: int,
 *   searchType?: SearchType|value-of<SearchType>,
 *   stream?: bool,
 *   temperature?: float,
 *   text?: bool,
 *   useCustomLLM?: bool,
 * }
 */
final class V1AnswerParams implements BaseModel
{
    /** @use SdkModel<V1AnswerParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The question or topic to research and answer.
     */
    #[Required]
    public string $query;

    /**
     * Exclude these domains from search.
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
     * Maximum tokens for LLM response.
     */
    #[Optional]
    public ?int $maxTokens;

    /**
     * LLM model to use when useCustomLLM is true.
     */
    #[Optional]
    public ?string $model;

    /**
     * Number of search results to consider.
     */
    #[Optional]
    public ?int $numResults;

    /**
     * Type of search to perform.
     *
     * @var value-of<SearchType>|null $searchType
     */
    #[Optional(enum: SearchType::class)]
    public ?string $searchType;

    /**
     * Stream the response (only for native provider answers).
     */
    #[Optional]
    public ?bool $stream;

    /**
     * LLM temperature for answer generation.
     */
    #[Optional]
    public ?float $temperature;

    /**
     * Include text content in response.
     */
    #[Optional]
    public ?bool $text;

    /**
     * Use Case.dev LLM for answer generation instead of provider's native answer.
     */
    #[Optional]
    public ?bool $useCustomLLM;

    /**
     * `new V1AnswerParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1AnswerParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1AnswerParams)->withQuery(...)
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
     * @param SearchType|value-of<SearchType> $searchType
     */
    public static function with(
        string $query,
        ?array $excludeDomains = null,
        ?array $includeDomains = null,
        ?int $maxTokens = null,
        ?string $model = null,
        ?int $numResults = null,
        SearchType|string|null $searchType = null,
        ?bool $stream = null,
        ?float $temperature = null,
        ?bool $text = null,
        ?bool $useCustomLLM = null,
    ): self {
        $obj = new self;

        $obj['query'] = $query;

        null !== $excludeDomains && $obj['excludeDomains'] = $excludeDomains;
        null !== $includeDomains && $obj['includeDomains'] = $includeDomains;
        null !== $maxTokens && $obj['maxTokens'] = $maxTokens;
        null !== $model && $obj['model'] = $model;
        null !== $numResults && $obj['numResults'] = $numResults;
        null !== $searchType && $obj['searchType'] = $searchType;
        null !== $stream && $obj['stream'] = $stream;
        null !== $temperature && $obj['temperature'] = $temperature;
        null !== $text && $obj['text'] = $text;
        null !== $useCustomLLM && $obj['useCustomLLM'] = $useCustomLLM;

        return $obj;
    }

    /**
     * The question or topic to research and answer.
     */
    public function withQuery(string $query): self
    {
        $obj = clone $this;
        $obj['query'] = $query;

        return $obj;
    }

    /**
     * Exclude these domains from search.
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
     * Maximum tokens for LLM response.
     */
    public function withMaxTokens(int $maxTokens): self
    {
        $obj = clone $this;
        $obj['maxTokens'] = $maxTokens;

        return $obj;
    }

    /**
     * LLM model to use when useCustomLLM is true.
     */
    public function withModel(string $model): self
    {
        $obj = clone $this;
        $obj['model'] = $model;

        return $obj;
    }

    /**
     * Number of search results to consider.
     */
    public function withNumResults(int $numResults): self
    {
        $obj = clone $this;
        $obj['numResults'] = $numResults;

        return $obj;
    }

    /**
     * Type of search to perform.
     *
     * @param SearchType|value-of<SearchType> $searchType
     */
    public function withSearchType(SearchType|string $searchType): self
    {
        $obj = clone $this;
        $obj['searchType'] = $searchType;

        return $obj;
    }

    /**
     * Stream the response (only for native provider answers).
     */
    public function withStream(bool $stream): self
    {
        $obj = clone $this;
        $obj['stream'] = $stream;

        return $obj;
    }

    /**
     * LLM temperature for answer generation.
     */
    public function withTemperature(float $temperature): self
    {
        $obj = clone $this;
        $obj['temperature'] = $temperature;

        return $obj;
    }

    /**
     * Include text content in response.
     */
    public function withText(bool $text): self
    {
        $obj = clone $this;
        $obj['text'] = $text;

        return $obj;
    }

    /**
     * Use Case.dev LLM for answer generation instead of provider's native answer.
     */
    public function withUseCustomLlm(bool $useCustomLlm): self
    {
        $obj = clone $this;
        $obj['useCustomLLM'] = $useCustomLlm;

        return $obj;
    }
}
