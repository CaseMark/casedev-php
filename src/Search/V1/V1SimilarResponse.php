<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Search\V1\V1SimilarResponse\Result;

/**
 * @phpstan-type V1SimilarResponseShape = array{
 *   processingTime?: float|null,
 *   results?: list<Result>|null,
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
     * @param list<Result|array{
     *   domain?: string|null,
     *   publishedDate?: string|null,
     *   similarityScore?: float|null,
     *   snippet?: string|null,
     *   text?: string|null,
     *   title?: string|null,
     *   url?: string|null,
     * }> $results
     */
    public static function with(
        ?float $processingTime = null,
        ?array $results = null,
        ?int $totalResults = null,
    ): self {
        $obj = new self;

        null !== $processingTime && $obj['processingTime'] = $processingTime;
        null !== $results && $obj['results'] = $results;
        null !== $totalResults && $obj['totalResults'] = $totalResults;

        return $obj;
    }

    public function withProcessingTime(float $processingTime): self
    {
        $obj = clone $this;
        $obj['processingTime'] = $processingTime;

        return $obj;
    }

    /**
     * @param list<Result|array{
     *   domain?: string|null,
     *   publishedDate?: string|null,
     *   similarityScore?: float|null,
     *   snippet?: string|null,
     *   text?: string|null,
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

    public function withTotalResults(int $totalResults): self
    {
        $obj = clone $this;
        $obj['totalResults'] = $totalResults;

        return $obj;
    }
}
