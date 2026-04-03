<?php

declare(strict_types=1);

namespace CaseDev\Vault\Memory;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\Memory\MemorySearchResponse\Result;

/**
 * @phpstan-import-type ResultShape from \CaseDev\Vault\Memory\MemorySearchResponse\Result
 *
 * @phpstan-type MemorySearchResponseShape = array{
 *   results?: list<Result|ResultShape>|null
 * }
 */
final class MemorySearchResponse implements BaseModel
{
    /** @use SdkModel<MemorySearchResponseShape> */
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
     * @param list<Result|ResultShape>|null $results
     */
    public static function with(?array $results = null): self
    {
        $self = new self;

        null !== $results && $self['results'] = $results;

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
