<?php

declare(strict_types=1);

namespace Casedev\Legal\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Perform comprehensive legal research with multiple query variations. Uses advanced deep search to find relevant sources across different phrasings of the legal issue.
 *
 * @see Casedev\Services\Legal\V1Service::research()
 *
 * @phpstan-type V1ResearchParamsShape = array{
 *   query: string,
 *   additionalQueries?: list<string>|null,
 *   jurisdiction?: string|null,
 *   numResults?: int|null,
 * }
 */
final class V1ResearchParams implements BaseModel
{
    /** @use SdkModel<V1ResearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Primary search query.
     */
    #[Required]
    public string $query;

    /**
     * Additional query variations to search (e.g., different phrasings of the legal issue).
     *
     * @var list<string>|null $additionalQueries
     */
    #[Optional(list: 'string')]
    public ?array $additionalQueries;

    /**
     * Optional jurisdiction ID from resolveJurisdiction.
     */
    #[Optional]
    public ?string $jurisdiction;

    /**
     * Number of results 1-25 (default: 10).
     */
    #[Optional]
    public ?int $numResults;

    /**
     * `new V1ResearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1ResearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1ResearchParams)->withQuery(...)
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
     * @param list<string>|null $additionalQueries
     */
    public static function with(
        string $query,
        ?array $additionalQueries = null,
        ?string $jurisdiction = null,
        ?int $numResults = null,
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $additionalQueries && $self['additionalQueries'] = $additionalQueries;
        null !== $jurisdiction && $self['jurisdiction'] = $jurisdiction;
        null !== $numResults && $self['numResults'] = $numResults;

        return $self;
    }

    /**
     * Primary search query.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Additional query variations to search (e.g., different phrasings of the legal issue).
     *
     * @param list<string> $additionalQueries
     */
    public function withAdditionalQueries(array $additionalQueries): self
    {
        $self = clone $this;
        $self['additionalQueries'] = $additionalQueries;

        return $self;
    }

    /**
     * Optional jurisdiction ID from resolveJurisdiction.
     */
    public function withJurisdiction(string $jurisdiction): self
    {
        $self = clone $this;
        $self['jurisdiction'] = $jurisdiction;

        return $self;
    }

    /**
     * Number of results 1-25 (default: 10).
     */
    public function withNumResults(int $numResults): self
    {
        $self = clone $this;
        $self['numResults'] = $numResults;

        return $self;
    }
}
