<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;
use Casedev\Search\V1\V1ContentsResponse\Result;

/**
 * @phpstan-type V1ContentsResponseShape = array{results?: list<Result>|null}
 */
final class V1ContentsResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<V1ContentsResponseShape> */
    use SdkModel;

    use SdkResponse;

    /** @var list<Result>|null $results */
    #[Api(list: Result::class, optional: true)]
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
     * @param list<Result> $results
     */
    public static function with(?array $results = null): self
    {
        $obj = new self;

        null !== $results && $obj->results = $results;

        return $obj;
    }

    /**
     * @param list<Result> $results
     */
    public function withResults(array $results): self
    {
        $obj = clone $this;
        $obj->results = $results;

        return $obj;
    }
}
