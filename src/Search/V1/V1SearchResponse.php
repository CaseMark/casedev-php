<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Search\V1\V1SearchResponse\Result;

/**
 * @phpstan-type V1SearchResponseShape = array{
 *   query?: string|null, results?: list<Result>|null, totalResults?: int|null
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
     * @param list<Result|array{
     *   domain?: string|null,
     *   publishedDate?: \DateTimeInterface|null,
     *   snippet?: string|null,
     *   title?: string|null,
     *   url?: string|null,
     * }> $results
     */
    public static function with(
        ?string $query = null,
        ?array $results = null,
        ?int $totalResults = null
    ): self {
        $obj = new self;

        null !== $query && $obj['query'] = $query;
        null !== $results && $obj['results'] = $results;
        null !== $totalResults && $obj['totalResults'] = $totalResults;

        return $obj;
    }

    /**
     * Original search query.
     */
    public function withQuery(string $query): self
    {
        $obj = clone $this;
        $obj['query'] = $query;

        return $obj;
    }

    /**
     * Array of search results.
     *
     * @param list<Result|array{
     *   domain?: string|null,
     *   publishedDate?: \DateTimeInterface|null,
     *   snippet?: string|null,
     *   title?: string|null,
     *   url?: string|null,
     * }> $results
     */
    public function withResults(array $results): self
    {
        $obj = clone $this;
        $obj['results'] = $results;

        return $obj;
    }

    /**
     * Total number of results found.
     */
    public function withTotalResults(int $totalResults): self
    {
        $obj = clone $this;
        $obj['totalResults'] = $totalResults;

        return $obj;
    }
}
