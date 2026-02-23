<?php

declare(strict_types=1);

namespace Router\Legal\V1\V1VerifyResponse\Citation;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * Case metadata (when verified).
 *
 * @phpstan-type CaseShape = array{
 *   id?: int|null,
 *   court?: string|null,
 *   dateDecided?: string|null,
 *   docketNumber?: string|null,
 *   name?: string|null,
 *   parallelCitations?: list<string>|null,
 *   shortName?: string|null,
 *   url?: string|null,
 * }
 */
final class Case_ implements BaseModel
{
    /** @use SdkModel<CaseShape> */
    use SdkModel;

    #[Optional]
    public ?int $id;

    #[Optional]
    public ?string $court;

    #[Optional]
    public ?string $dateDecided;

    #[Optional]
    public ?string $docketNumber;

    #[Optional]
    public ?string $name;

    /** @var list<string>|null $parallelCitations */
    #[Optional(list: 'string')]
    public ?array $parallelCitations;

    #[Optional]
    public ?string $shortName;

    #[Optional]
    public ?string $url;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $parallelCitations
     */
    public static function with(
        ?int $id = null,
        ?string $court = null,
        ?string $dateDecided = null,
        ?string $docketNumber = null,
        ?string $name = null,
        ?array $parallelCitations = null,
        ?string $shortName = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $court && $self['court'] = $court;
        null !== $dateDecided && $self['dateDecided'] = $dateDecided;
        null !== $docketNumber && $self['docketNumber'] = $docketNumber;
        null !== $name && $self['name'] = $name;
        null !== $parallelCitations && $self['parallelCitations'] = $parallelCitations;
        null !== $shortName && $self['shortName'] = $shortName;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withID(int $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCourt(string $court): self
    {
        $self = clone $this;
        $self['court'] = $court;

        return $self;
    }

    public function withDateDecided(string $dateDecided): self
    {
        $self = clone $this;
        $self['dateDecided'] = $dateDecided;

        return $self;
    }

    public function withDocketNumber(string $docketNumber): self
    {
        $self = clone $this;
        $self['docketNumber'] = $docketNumber;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param list<string> $parallelCitations
     */
    public function withParallelCitations(array $parallelCitations): self
    {
        $self = clone $this;
        $self['parallelCitations'] = $parallelCitations;

        return $self;
    }

    public function withShortName(string $shortName): self
    {
        $self = clone $this;
        $self['shortName'] = $shortName;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
