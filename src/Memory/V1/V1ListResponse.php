<?php

declare(strict_types=1);

namespace Casedev\Memory\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Memory\V1\V1ListResponse\Result;

/**
 * @phpstan-import-type ResultShape from \Casedev\Memory\V1\V1ListResponse\Result
 *
 * @phpstan-type V1ListResponseShape = array{
 *   count?: int|null, results?: list<Result|ResultShape>|null
 * }
 */
final class V1ListResponse implements BaseModel
{
    /** @use SdkModel<V1ListResponseShape> */
    use SdkModel;

    /**
     * Total count matching filters.
     */
    #[Optional]
    public ?int $count;

    /** @var list<Result>|null $results */
    #[Optional(list: Result::class)]
    public ?array $results;

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
    public static function with(?int $count = null, ?array $results = null): self
    {
        $self = new self;

        null !== $count && $self['count'] = $count;
        null !== $results && $self['results'] = $results;

        return $self;
    }

    /**
     * Total count matching filters.
     */
    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    /**
     * @param list<Result|ResultShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
