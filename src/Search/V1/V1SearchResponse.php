<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Search\V1\V1SearchResponse\Result;

/**
 * @phpstan-import-type ResultShape from \Casedev\Search\V1\V1SearchResponse\Result
 *
 * @phpstan-type V1SearchResponseShape = array{
 *   query?: string|null, results?: list<ResultShape>|null, totalResults?: int|null
 * }
 */
final class V1SearchResponse implements BaseModel
{
    /** @use SdkModel<V1SearchResponseShape> */
    use SdkModel;

    /**
     * Original search query.
     */
    #[Optional]
    public ?string $query;

    /**
     * Array of search results.
     *
     * @var list<Result>|null $results
     */
    #[Optional(list: Result::class)]
    public ?array $results;

    /**
     * Total number of results found.
     */
    #[Optional]
    public ?int $totalResults;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<ResultShape> $results
     */
    public static function with(
        ?string $query = null,
        ?array $results = null,
        ?int $totalResults = null
    ): self {
        $self = new self;

        null !== $query && $self['query'] = $query;
        null !== $results && $self['results'] = $results;
        null !== $totalResults && $self['totalResults'] = $totalResults;

        return $self;
    }

    /**
     * Original search query.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Array of search results.
     *
     * @param list<ResultShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }

    /**
     * Total number of results found.
     */
    public function withTotalResults(int $totalResults): self
    {
        $self = clone $this;
        $self['totalResults'] = $totalResults;

        return $self;
    }
}
