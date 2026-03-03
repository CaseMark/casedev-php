<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1ListCourtsResponse\Court;

/**
 * @phpstan-import-type CourtShape from \CaseDev\Legal\V1\V1ListCourtsResponse\Court
 *
 * @phpstan-type V1ListCourtsResponseShape = array{
 *   courts?: list<Court|CourtShape>|null,
 *   found?: int|null,
 *   inUseOnly?: bool|null,
 *   jurisdiction?: string|null,
 *   query?: string|null,
 * }
 */
final class V1ListCourtsResponse implements BaseModel
{
    /** @use SdkModel<V1ListCourtsResponseShape> */
    use SdkModel;

    /** @var list<Court>|null $courts */
    #[Optional(list: Court::class)]
    public ?array $courts;

    #[Optional]
    public ?int $found;

    /**
     * Whether results are filtered to in-use courts only.
     */
    #[Optional]
    public ?bool $inUseOnly;

    #[Optional(nullable: true)]
    public ?string $jurisdiction;

    #[Optional(nullable: true)]
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
     * @param list<Court|CourtShape>|null $courts
     */
    public static function with(
        ?array $courts = null,
        ?int $found = null,
        ?bool $inUseOnly = null,
        ?string $jurisdiction = null,
        ?string $query = null,
    ): self {
        $self = new self;

        null !== $courts && $self['courts'] = $courts;
        null !== $found && $self['found'] = $found;
        null !== $inUseOnly && $self['inUseOnly'] = $inUseOnly;
        null !== $jurisdiction && $self['jurisdiction'] = $jurisdiction;
        null !== $query && $self['query'] = $query;

        return $self;
    }

    /**
     * @param list<Court|CourtShape> $courts
     */
    public function withCourts(array $courts): self
    {
        $self = clone $this;
        $self['courts'] = $courts;

        return $self;
    }

    public function withFound(int $found): self
    {
        $self = clone $this;
        $self['found'] = $found;

        return $self;
    }

    /**
     * Whether results are filtered to in-use courts only.
     */
    public function withInUseOnly(bool $inUseOnly): self
    {
        $self = clone $this;
        $self['inUseOnly'] = $inUseOnly;

        return $self;
    }

    public function withJurisdiction(?string $jurisdiction): self
    {
        $self = clone $this;
        $self['jurisdiction'] = $jurisdiction;

        return $self;
    }

    public function withQuery(?string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }
}
