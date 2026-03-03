<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1ListCourtsResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type CourtShape = array{
 *   id?: string|null,
 *   fullName?: string|null,
 *   jurisdiction?: string|null,
 *   pacerCourtID?: int|null,
 *   shortName?: string|null,
 * }
 */
final class Court implements BaseModel
{
    /** @use SdkModel<CourtShape> */
    use SdkModel;

    /**
     * CourtListener court slug.
     */
    #[Optional]
    public ?string $id;

    #[Optional(nullable: true)]
    public ?string $fullName;

    #[Optional(nullable: true)]
    public ?string $jurisdiction;

    #[Optional('pacerCourtId', nullable: true)]
    public ?int $pacerCourtID;

    #[Optional(nullable: true)]
    public ?string $shortName;

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
        ?string $id = null,
        ?string $fullName = null,
        ?string $jurisdiction = null,
        ?int $pacerCourtID = null,
        ?string $shortName = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $fullName && $self['fullName'] = $fullName;
        null !== $jurisdiction && $self['jurisdiction'] = $jurisdiction;
        null !== $pacerCourtID && $self['pacerCourtID'] = $pacerCourtID;
        null !== $shortName && $self['shortName'] = $shortName;

        return $self;
    }

    /**
     * CourtListener court slug.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withFullName(?string $fullName): self
    {
        $self = clone $this;
        $self['fullName'] = $fullName;

        return $self;
    }

    public function withJurisdiction(?string $jurisdiction): self
    {
        $self = clone $this;
        $self['jurisdiction'] = $jurisdiction;

        return $self;
    }

    public function withPacerCourtID(?int $pacerCourtID): self
    {
        $self = clone $this;
        $self['pacerCourtID'] = $pacerCourtID;

        return $self;
    }

    public function withShortName(?string $shortName): self
    {
        $self = clone $this;
        $self['shortName'] = $shortName;

        return $self;
    }
}
