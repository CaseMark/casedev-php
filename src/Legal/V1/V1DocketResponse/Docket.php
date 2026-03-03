<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1DocketResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Full docket record (lookup mode).
 *
 * @phpstan-type DocketShape = array{
 *   id?: string|null,
 *   assignedTo?: string|null,
 *   caseName?: string|null,
 *   cause?: string|null,
 *   court?: string|null,
 *   courtID?: string|null,
 *   dateFiled?: string|null,
 *   dateTerminated?: string|null,
 *   docketNumber?: string|null,
 *   natureOfSuit?: string|null,
 *   pacerCaseID?: string|null,
 *   parties?: list<string>|null,
 *   url?: string|null,
 * }
 */
final class Docket implements BaseModel
{
    /** @use SdkModel<DocketShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional(nullable: true)]
    public ?string $assignedTo;

    #[Optional(nullable: true)]
    public ?string $caseName;

    #[Optional(nullable: true)]
    public ?string $cause;

    #[Optional(nullable: true)]
    public ?string $court;

    #[Optional('courtId', nullable: true)]
    public ?string $courtID;

    #[Optional(nullable: true)]
    public ?string $dateFiled;

    #[Optional(nullable: true)]
    public ?string $dateTerminated;

    #[Optional(nullable: true)]
    public ?string $docketNumber;

    #[Optional(nullable: true)]
    public ?string $natureOfSuit;

    #[Optional('pacerCaseId', nullable: true)]
    public ?string $pacerCaseID;

    /** @var list<string>|null $parties */
    #[Optional(list: 'string')]
    public ?array $parties;

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
     * @param list<string>|null $parties
     */
    public static function with(
        ?string $id = null,
        ?string $assignedTo = null,
        ?string $caseName = null,
        ?string $cause = null,
        ?string $court = null,
        ?string $courtID = null,
        ?string $dateFiled = null,
        ?string $dateTerminated = null,
        ?string $docketNumber = null,
        ?string $natureOfSuit = null,
        ?string $pacerCaseID = null,
        ?array $parties = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $assignedTo && $self['assignedTo'] = $assignedTo;
        null !== $caseName && $self['caseName'] = $caseName;
        null !== $cause && $self['cause'] = $cause;
        null !== $court && $self['court'] = $court;
        null !== $courtID && $self['courtID'] = $courtID;
        null !== $dateFiled && $self['dateFiled'] = $dateFiled;
        null !== $dateTerminated && $self['dateTerminated'] = $dateTerminated;
        null !== $docketNumber && $self['docketNumber'] = $docketNumber;
        null !== $natureOfSuit && $self['natureOfSuit'] = $natureOfSuit;
        null !== $pacerCaseID && $self['pacerCaseID'] = $pacerCaseID;
        null !== $parties && $self['parties'] = $parties;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withAssignedTo(?string $assignedTo): self
    {
        $self = clone $this;
        $self['assignedTo'] = $assignedTo;

        return $self;
    }

    public function withCaseName(?string $caseName): self
    {
        $self = clone $this;
        $self['caseName'] = $caseName;

        return $self;
    }

    public function withCause(?string $cause): self
    {
        $self = clone $this;
        $self['cause'] = $cause;

        return $self;
    }

    public function withCourt(?string $court): self
    {
        $self = clone $this;
        $self['court'] = $court;

        return $self;
    }

    public function withCourtID(?string $courtID): self
    {
        $self = clone $this;
        $self['courtID'] = $courtID;

        return $self;
    }

    public function withDateFiled(?string $dateFiled): self
    {
        $self = clone $this;
        $self['dateFiled'] = $dateFiled;

        return $self;
    }

    public function withDateTerminated(?string $dateTerminated): self
    {
        $self = clone $this;
        $self['dateTerminated'] = $dateTerminated;

        return $self;
    }

    public function withDocketNumber(?string $docketNumber): self
    {
        $self = clone $this;
        $self['docketNumber'] = $docketNumber;

        return $self;
    }

    public function withNatureOfSuit(?string $natureOfSuit): self
    {
        $self = clone $this;
        $self['natureOfSuit'] = $natureOfSuit;

        return $self;
    }

    public function withPacerCaseID(?string $pacerCaseID): self
    {
        $self = clone $this;
        $self['pacerCaseID'] = $pacerCaseID;

        return $self;
    }

    /**
     * @param list<string> $parties
     */
    public function withParties(array $parties): self
    {
        $self = clone $this;
        $self['parties'] = $parties;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
