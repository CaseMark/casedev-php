<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Search\V1\V1ContentsResponse\Result;

/**
 * @phpstan-type V1ContentsResponseShape = array{results?: list<Result>|null}
 */
final class V1ContentsResponse implements BaseModel
{
    /** @use SdkModel<V1ContentsResponseShape> */
    use SdkModel;

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
     * @param list<Result|array{
     *   highlights?: list<string>|null,
     *   metadata?: mixed,
     *   summary?: string|null,
     *   text?: string|null,
     *   title?: string|null,
     *   url?: string|null,
     * }> $results
     */
    public static function with(?array $results = null): self
    {
        $self = new self;

        null !== $results && $self['results'] = $results;

        return $self;
    }

    /**
     * @param list<Result|array{
     *   highlights?: list<string>|null,
     *   metadata?: mixed,
     *   summary?: string|null,
     *   text?: string|null,
     *   title?: string|null,
     *   url?: string|null,
     * }> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
