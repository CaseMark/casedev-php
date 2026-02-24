<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1PatentSearchResponse\Result;

/**
 * @phpstan-import-type ResultShape from \CaseDev\Legal\V1\V1PatentSearchResponse\Result
 *
 * @phpstan-type V1PatentSearchResponseShape = array{
 *   limit?: int|null,
 *   offset?: int|null,
 *   query?: string|null,
 *   results?: list<Result|ResultShape>|null,
 *   totalResults?: int|null,
 * }
 */
final class V1PatentSearchResponse implements BaseModel
{
    /** @use SdkModel<V1PatentSearchResponseShape> */
    use SdkModel;

    /**
     * Number of results returned.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Current pagination offset.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Original search query.
     */
    #[Optional]
    public ?string $query;

    /**
     * Array of matching patent applications.
     *
     * @var list<Result>|null $results
     */
    #[Optional(list: Result::class)]
    public ?array $results;

    /**
     * Total number of matching patent applications.
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
     * @param list<Result|ResultShape>|null $results
     */
    public static function with(
        ?int $limit = null,
        ?int $offset = null,
        ?string $query = null,
        ?array $results = null,
        ?int $totalResults = null,
    ): self {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $query && $self['query'] = $query;
        null !== $results && $self['results'] = $results;
        null !== $totalResults && $self['totalResults'] = $totalResults;

        return $self;
    }

    /**
     * Number of results returned.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Current pagination offset.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

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
     * Array of matching patent applications.
     *
     * @param list<Result|ResultShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }

    /**
     * Total number of matching patent applications.
     */
    public function withTotalResults(int $totalResults): self
    {
        $self = clone $this;
        $self['totalResults'] = $totalResults;

        return $self;
    }
}
