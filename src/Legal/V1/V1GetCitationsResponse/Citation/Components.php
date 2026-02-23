<?php

declare(strict_types=1);

namespace Router\Legal\V1\V1GetCitationsResponse\Citation;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * Structured Bluebook components. Null if citation format is not recognized.
 *
 * @phpstan-type ComponentsShape = array{
 *   caseName?: string|null,
 *   court?: string|null,
 *   page?: int|null,
 *   pinCite?: int|null,
 *   reporter?: string|null,
 *   volume?: int|null,
 *   year?: int|null,
 * }
 */
final class Components implements BaseModel
{
    /** @use SdkModel<ComponentsShape> */
    use SdkModel;

    /**
     * Case name, e.g., "Bush v. Gore".
     */
    #[Optional]
    public ?string $caseName;

    /**
     * Court identifier.
     */
    #[Optional]
    public ?string $court;

    /**
     * Starting page number.
     */
    #[Optional]
    public ?int $page;

    /**
     * Pin cite (specific page).
     */
    #[Optional]
    public ?int $pinCite;

    /**
     * Reporter abbreviation, e.g., "U.S.".
     */
    #[Optional]
    public ?string $reporter;

    /**
     * Volume number.
     */
    #[Optional]
    public ?int $volume;

    /**
     * Decision year.
     */
    #[Optional]
    public ?int $year;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $caseName = null,
        ?string $court = null,
        ?int $page = null,
        ?int $pinCite = null,
        ?string $reporter = null,
        ?int $volume = null,
        ?int $year = null,
    ): self {
        $self = new self;

        null !== $caseName && $self['caseName'] = $caseName;
        null !== $court && $self['court'] = $court;
        null !== $page && $self['page'] = $page;
        null !== $pinCite && $self['pinCite'] = $pinCite;
        null !== $reporter && $self['reporter'] = $reporter;
        null !== $volume && $self['volume'] = $volume;
        null !== $year && $self['year'] = $year;

        return $self;
    }

    /**
     * Case name, e.g., "Bush v. Gore".
     */
    public function withCaseName(string $caseName): self
    {
        $self = clone $this;
        $self['caseName'] = $caseName;

        return $self;
    }

    /**
     * Court identifier.
     */
    public function withCourt(string $court): self
    {
        $self = clone $this;
        $self['court'] = $court;

        return $self;
    }

    /**
     * Starting page number.
     */
    public function withPage(int $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    /**
     * Pin cite (specific page).
     */
    public function withPinCite(int $pinCite): self
    {
        $self = clone $this;
        $self['pinCite'] = $pinCite;

        return $self;
    }

    /**
     * Reporter abbreviation, e.g., "U.S.".
     */
    public function withReporter(string $reporter): self
    {
        $self = clone $this;
        $self['reporter'] = $reporter;

        return $self;
    }

    /**
     * Volume number.
     */
    public function withVolume(int $volume): self
    {
        $self = clone $this;
        $self['volume'] = $volume;

        return $self;
    }

    /**
     * Decision year.
     */
    public function withYear(int $year): self
    {
        $self = clone $this;
        $self['year'] = $year;

        return $self;
    }
}
