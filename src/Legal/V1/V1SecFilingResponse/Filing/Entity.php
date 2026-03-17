<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1SecFilingResponse\Filing;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type EntityShape = array{
 *   cik?: string|null,
 *   entityType?: string|null,
 *   name?: string|null,
 *   sic?: string|null,
 *   sicDescription?: string|null,
 *   stateOfIncorporation?: string|null,
 *   ticker?: string|null,
 * }
 */
final class Entity implements BaseModel
{
    /** @use SdkModel<EntityShape> */
    use SdkModel;

    #[Optional]
    public ?string $cik;

    #[Optional(nullable: true)]
    public ?string $entityType;

    #[Optional(nullable: true)]
    public ?string $name;

    #[Optional(nullable: true)]
    public ?string $sic;

    #[Optional(nullable: true)]
    public ?string $sicDescription;

    #[Optional(nullable: true)]
    public ?string $stateOfIncorporation;

    #[Optional(nullable: true)]
    public ?string $ticker;

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
        ?string $cik = null,
        ?string $entityType = null,
        ?string $name = null,
        ?string $sic = null,
        ?string $sicDescription = null,
        ?string $stateOfIncorporation = null,
        ?string $ticker = null,
    ): self {
        $self = new self;

        null !== $cik && $self['cik'] = $cik;
        null !== $entityType && $self['entityType'] = $entityType;
        null !== $name && $self['name'] = $name;
        null !== $sic && $self['sic'] = $sic;
        null !== $sicDescription && $self['sicDescription'] = $sicDescription;
        null !== $stateOfIncorporation && $self['stateOfIncorporation'] = $stateOfIncorporation;
        null !== $ticker && $self['ticker'] = $ticker;

        return $self;
    }

    public function withCik(string $cik): self
    {
        $self = clone $this;
        $self['cik'] = $cik;

        return $self;
    }

    public function withEntityType(?string $entityType): self
    {
        $self = clone $this;
        $self['entityType'] = $entityType;

        return $self;
    }

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withSic(?string $sic): self
    {
        $self = clone $this;
        $self['sic'] = $sic;

        return $self;
    }

    public function withSicDescription(?string $sicDescription): self
    {
        $self = clone $this;
        $self['sicDescription'] = $sicDescription;

        return $self;
    }

    public function withStateOfIncorporation(
        ?string $stateOfIncorporation
    ): self {
        $self = clone $this;
        $self['stateOfIncorporation'] = $stateOfIncorporation;

        return $self;
    }

    public function withTicker(?string $ticker): self
    {
        $self = clone $this;
        $self['ticker'] = $ticker;

        return $self;
    }
}
