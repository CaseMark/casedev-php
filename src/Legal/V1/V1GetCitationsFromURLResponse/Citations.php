<?php

declare(strict_types=1);

namespace Router\Legal\V1\V1GetCitationsFromURLResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Legal\V1\V1GetCitationsFromURLResponse\Citations\Case_;
use Router\Legal\V1\V1GetCitationsFromURLResponse\Citations\Regulation;
use Router\Legal\V1\V1GetCitationsFromURLResponse\Citations\Statute;

/**
 * @phpstan-import-type CaseShape from \Router\Legal\V1\V1GetCitationsFromURLResponse\Citations\Case_
 * @phpstan-import-type RegulationShape from \Router\Legal\V1\V1GetCitationsFromURLResponse\Citations\Regulation
 * @phpstan-import-type StatuteShape from \Router\Legal\V1\V1GetCitationsFromURLResponse\Citations\Statute
 *
 * @phpstan-type CitationsShape = array{
 *   cases?: list<Case_|CaseShape>|null,
 *   regulations?: list<Regulation|RegulationShape>|null,
 *   statutes?: list<Statute|StatuteShape>|null,
 * }
 */
final class Citations implements BaseModel
{
    /** @use SdkModel<CitationsShape> */
    use SdkModel;

    /** @var list<Case_>|null $cases */
    #[Optional(list: Case_::class)]
    public ?array $cases;

    /** @var list<Regulation>|null $regulations */
    #[Optional(list: Regulation::class)]
    public ?array $regulations;

    /** @var list<Statute>|null $statutes */
    #[Optional(list: Statute::class)]
    public ?array $statutes;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Case_|CaseShape>|null $cases
     * @param list<Regulation|RegulationShape>|null $regulations
     * @param list<Statute|StatuteShape>|null $statutes
     */
    public static function with(
        ?array $cases = null,
        ?array $regulations = null,
        ?array $statutes = null
    ): self {
        $self = new self;

        null !== $cases && $self['cases'] = $cases;
        null !== $regulations && $self['regulations'] = $regulations;
        null !== $statutes && $self['statutes'] = $statutes;

        return $self;
    }

    /**
     * @param list<Case_|CaseShape> $cases
     */
    public function withCases(array $cases): self
    {
        $self = clone $this;
        $self['cases'] = $cases;

        return $self;
    }

    /**
     * @param list<Regulation|RegulationShape> $regulations
     */
    public function withRegulations(array $regulations): self
    {
        $self = clone $this;
        $self['regulations'] = $regulations;

        return $self;
    }

    /**
     * @param list<Statute|StatuteShape> $statutes
     */
    public function withStatutes(array $statutes): self
    {
        $self = clone $this;
        $self['statutes'] = $statutes;

        return $self;
    }
}
