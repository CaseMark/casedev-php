<?php

declare(strict_types=1);

namespace Router\Legal\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Legal\V1\V1FindResponse\Candidate;

/**
 * @phpstan-import-type CandidateShape from \Router\Legal\V1\V1FindResponse\Candidate
 *
 * @phpstan-type V1FindResponseShape = array{
 *   candidates?: list<Candidate|CandidateShape>|null,
 *   found?: int|null,
 *   hint?: string|null,
 *   jurisdiction?: string|null,
 *   query?: string|null,
 * }
 */
final class V1FindResponse implements BaseModel
{
    /** @use SdkModel<V1FindResponseShape> */
    use SdkModel;

    /** @var list<Candidate>|null $candidates */
    #[Optional(list: Candidate::class)]
    public ?array $candidates;

    /**
     * Number of candidates found.
     */
    #[Optional]
    public ?int $found;

    /**
     * Usage guidance.
     */
    #[Optional]
    public ?string $hint;

    /**
     * Jurisdiction filter applied.
     */
    #[Optional]
    public ?string $jurisdiction;

    /**
     * Original search query.
     */
    #[Optional]
    public ?string $query;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Candidate|CandidateShape>|null $candidates
     */
    public static function with(
        ?array $candidates = null,
        ?int $found = null,
        ?string $hint = null,
        ?string $jurisdiction = null,
        ?string $query = null,
    ): self {
        $self = new self;

        null !== $candidates && $self['candidates'] = $candidates;
        null !== $found && $self['found'] = $found;
        null !== $hint && $self['hint'] = $hint;
        null !== $jurisdiction && $self['jurisdiction'] = $jurisdiction;
        null !== $query && $self['query'] = $query;

        return $self;
    }

    /**
     * @param list<Candidate|CandidateShape> $candidates
     */
    public function withCandidates(array $candidates): self
    {
        $self = clone $this;
        $self['candidates'] = $candidates;

        return $self;
    }

    /**
     * Number of candidates found.
     */
    public function withFound(int $found): self
    {
        $self = clone $this;
        $self['found'] = $found;

        return $self;
    }

    /**
     * Usage guidance.
     */
    public function withHint(string $hint): self
    {
        $self = clone $this;
        $self['hint'] = $hint;

        return $self;
    }

    /**
     * Jurisdiction filter applied.
     */
    public function withJurisdiction(string $jurisdiction): self
    {
        $self = clone $this;
        $self['jurisdiction'] = $jurisdiction;

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
}
