<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Search\V1\V1SimilarResponse\Result;

/**
 * @phpstan-import-type ResultShape from \Casedev\Search\V1\V1SimilarResponse\Result
 *
 * @phpstan-type V1SimilarResponseShape = array{
 *   processingTime?: float|null,
 *   results?: list<Result|ResultShape>|null,
 *   totalResults?: int|null,
 * }
 */
final class V1SimilarResponse implements BaseModel
{
    /** @use SdkModel<V1SimilarResponseShape> */
    use SdkModel;

    #[Optional]
    public ?float $processingTime;

    /** @var list<Result>|null $results */
    #[Optional(list: Result::class)]
    public ?array $results;

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
        ?float $processingTime = null,
        ?array $results = null,
        ?int $totalResults = null,
    ): self {
        $self = new self;

        null !== $processingTime && $self['processingTime'] = $processingTime;
        null !== $results && $self['results'] = $results;
        null !== $totalResults && $self['totalResults'] = $totalResults;

        return $self;
    }

    public function withProcessingTime(float $processingTime): self
    {
        $self = clone $this;
        $self['processingTime'] = $processingTime;

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

    public function withTotalResults(int $totalResults): self
    {
        $self = clone $this;
        $self['totalResults'] = $totalResults;

        return $self;
    }
}
