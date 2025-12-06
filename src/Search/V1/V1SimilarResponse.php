<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;
use Casedev\Search\V1\V1SimilarResponse\Result;

/**
 * @phpstan-type V1SimilarResponseShape = array{
 *   processingTime?: float|null,
 *   results?: list<Result>|null,
 *   totalResults?: int|null,
 * }
 */
final class V1SimilarResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<V1SimilarResponseShape> */
    use SdkModel;

    use SdkResponse;

    #[Api(optional: true)]
    public ?float $processingTime;

    /** @var list<Result>|null $results */
    #[Api(list: Result::class, optional: true)]
    public ?array $results;

    #[Api(optional: true)]
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
