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
 *   useCustomLlm?: bool,
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
    #[Optional('useCustomLLM')]
    public ?bool $useCustomLlm;

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
        ?bool $useCustomLlm = null,
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $excludeDomains && $self['excludeDomains'] = $excludeDomains;
        null !== $includeDomains && $self['includeDomains'] = $includeDomains;
        null !== $maxTokens && $self['maxTokens'] = $maxTokens;
        null !== $model && $self['model'] = $model;
        null !== $numResults && $self['numResults'] = $numResults;
        null !== $searchType && $self['searchType'] = $searchType;
        null !== $stream && $self['stream'] = $stream;
        null !== $temperature && $self['temperature'] = $temperature;
        null !== $text && $self['text'] = $text;
        null !== $useCustomLlm && $self['useCustomLlm'] = $useCustomLlm;

        return $self;
    }

    /**
     * The question or topic to research and answer.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Exclude these domains from search.
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
     * Maximum tokens for LLM response.
     */
    public function withMaxTokens(int $maxTokens): self
    {
        $self = clone $this;
        $self['maxTokens'] = $maxTokens;

        return $self;
    }

    /**
     * LLM model to use when useCustomLLM is true.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Number of search results to consider.
     */
    public function withNumResults(int $numResults): self
    {
        $self = clone $this;
        $self['numResults'] = $numResults;

        return $self;
    }

    /**
     * Type of search to perform.
     *
     * @param SearchType|value-of<SearchType> $searchType
     */
    public function withSearchType(SearchType|string $searchType): self
    {
        $self = clone $this;
        $self['searchType'] = $searchType;

        return $self;
    }

    /**
     * Stream the response (only for native provider answers).
     */
    public function withStream(bool $stream): self
    {
        $self = clone $this;
        $self['stream'] = $stream;

        return $self;
    }

    /**
     * LLM temperature for answer generation.
     */
    public function withTemperature(float $temperature): self
    {
        $self = clone $this;
        $self['temperature'] = $temperature;

        return $self;
    }

    /**
     * Include text content in response.
     */
    public function withText(bool $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Use Case.dev LLM for answer generation instead of provider's native answer.
     */
    public function withUseCustomLlm(bool $useCustomLlm): self
    {
        $self = clone $this;
        $self['useCustomLlm'] = $useCustomLlm;

        return $self;
    }
}
