<?php

declare(strict_types=1);

namespace Router\Legal\V1\V1PatentSearchResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResultShape = array{
 *   applicationNumber?: string|null,
 *   applicationType?: string|null,
 *   assignees?: list<string>|null,
 *   entityStatus?: string|null,
 *   filingDate?: string|null,
 *   grantDate?: string|null,
 *   inventors?: list<string>|null,
 *   patentNumber?: string|null,
 *   status?: string|null,
 *   title?: string|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Patent application serial number.
     */
    #[Optional]
    public ?string $applicationNumber;

    /**
     * Application type (Utility, Design, Plant, etc.).
     */
    #[Optional]
    public ?string $applicationType;

    /**
     * List of assignee/owner names.
     *
     * @var list<string>|null $assignees
     */
    #[Optional(list: 'string')]
    public ?array $assignees;

    /**
     * Entity status (e.g. "Small Entity", "Micro Entity").
     */
    #[Optional(nullable: true)]
    public ?string $entityStatus;

    /**
     * Date the application was filed.
     */
    #[Optional(nullable: true)]
    public ?string $filingDate;

    /**
     * Date the patent was granted.
     */
    #[Optional(nullable: true)]
    public ?string $grantDate;

    /**
     * List of inventor names.
     *
     * @var list<string>|null $inventors
     */
    #[Optional(list: 'string')]
    public ?array $inventors;

    /**
     * Granted patent number (if granted).
     */
    #[Optional(nullable: true)]
    public ?string $patentNumber;

    /**
     * Current application status (e.g. "Patented Case", "Pending").
     */
    #[Optional]
    public ?string $status;

    /**
     * Invention title.
     */
    #[Optional]
    public ?string $title;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $assignees
     * @param list<string>|null $inventors
     */
    public static function with(
        ?string $applicationNumber = null,
        ?string $applicationType = null,
        ?array $assignees = null,
        ?string $entityStatus = null,
        ?string $filingDate = null,
        ?string $grantDate = null,
        ?array $inventors = null,
        ?string $patentNumber = null,
        ?string $status = null,
        ?string $title = null,
    ): self {
        $self = new self;

        null !== $applicationNumber && $self['applicationNumber'] = $applicationNumber;
        null !== $applicationType && $self['applicationType'] = $applicationType;
        null !== $assignees && $self['assignees'] = $assignees;
        null !== $entityStatus && $self['entityStatus'] = $entityStatus;
        null !== $filingDate && $self['filingDate'] = $filingDate;
        null !== $grantDate && $self['grantDate'] = $grantDate;
        null !== $inventors && $self['inventors'] = $inventors;
        null !== $patentNumber && $self['patentNumber'] = $patentNumber;
        null !== $status && $self['status'] = $status;
        null !== $title && $self['title'] = $title;

        return $self;
    }

    /**
     * Patent application serial number.
     */
    public function withApplicationNumber(string $applicationNumber): self
    {
        $self = clone $this;
        $self['applicationNumber'] = $applicationNumber;

        return $self;
    }

    /**
     * Application type (Utility, Design, Plant, etc.).
     */
    public function withApplicationType(string $applicationType): self
    {
        $self = clone $this;
        $self['applicationType'] = $applicationType;

        return $self;
    }

    /**
     * List of assignee/owner names.
     *
     * @param list<string> $assignees
     */
    public function withAssignees(array $assignees): self
    {
        $self = clone $this;
        $self['assignees'] = $assignees;

        return $self;
    }

    /**
     * Entity status (e.g. "Small Entity", "Micro Entity").
     */
    public function withEntityStatus(?string $entityStatus): self
    {
        $self = clone $this;
        $self['entityStatus'] = $entityStatus;

        return $self;
    }

    /**
     * Date the application was filed.
     */
    public function withFilingDate(?string $filingDate): self
    {
        $self = clone $this;
        $self['filingDate'] = $filingDate;

        return $self;
    }

    /**
     * Date the patent was granted.
     */
    public function withGrantDate(?string $grantDate): self
    {
        $self = clone $this;
        $self['grantDate'] = $grantDate;

        return $self;
    }

    /**
     * List of inventor names.
     *
     * @param list<string> $inventors
     */
    public function withInventors(array $inventors): self
    {
        $self = clone $this;
        $self['inventors'] = $inventors;

        return $self;
    }

    /**
     * Granted patent number (if granted).
     */
    public function withPatentNumber(?string $patentNumber): self
    {
        $self = clone $this;
        $self['patentNumber'] = $patentNumber;

        return $self;
    }

    /**
     * Current application status (e.g. "Patented Case", "Pending").
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Invention title.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
