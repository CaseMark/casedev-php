<?php

declare(strict_types=1);

namespace Router\Legal\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;
use Router\Legal\V1\V1PatentSearchParams\ApplicationType;
use Router\Legal\V1\V1PatentSearchParams\SortBy;
use Router\Legal\V1\V1PatentSearchParams\SortOrder;

/**
 * Search the USPTO Open Data Portal for US patent applications and granted patents. Supports free-text queries, field-specific search, filters by assignee/inventor/status/type, date ranges, and pagination. Covers applications filed on or after January 1, 2001. Data is refreshed daily.
 *
 * @see Router\Services\Legal\V1Service::patentSearch()
 *
 * @phpstan-type V1PatentSearchParamsShape = array{
 *   query: string,
 *   applicationStatus?: string|null,
 *   applicationType?: null|ApplicationType|value-of<ApplicationType>,
 *   assignee?: string|null,
 *   filingDateFrom?: string|null,
 *   filingDateTo?: string|null,
 *   grantDateFrom?: string|null,
 *   grantDateTo?: string|null,
 *   inventor?: string|null,
 *   limit?: int|null,
 *   offset?: int|null,
 *   sortBy?: null|SortBy|value-of<SortBy>,
 *   sortOrder?: null|SortOrder|value-of<SortOrder>,
 * }
 */
final class V1PatentSearchParams implements BaseModel
{
    /** @use SdkModel<V1PatentSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Free-text search across all patent fields, or field-specific query (e.g. "applicationMetaData.patentNumber:11234567"). Supports AND, OR, NOT operators.
     */
    #[Required]
    public string $query;

    /**
     * Filter by application status (e.g. "Patented Case", "Abandoned", "Pending").
     */
    #[Optional]
    public ?string $applicationStatus;

    /**
     * Filter by application type.
     *
     * @var value-of<ApplicationType>|null $applicationType
     */
    #[Optional(enum: ApplicationType::class)]
    public ?string $applicationType;

    /**
     * Filter by assignee/owner name (e.g. "Google LLC").
     */
    #[Optional]
    public ?string $assignee;

    /**
     * Start of filing date range (YYYY-MM-DD).
     */
    #[Optional]
    public ?string $filingDateFrom;

    /**
     * End of filing date range (YYYY-MM-DD).
     */
    #[Optional]
    public ?string $filingDateTo;

    /**
     * Start of grant date range (YYYY-MM-DD).
     */
    #[Optional]
    public ?string $grantDateFrom;

    /**
     * End of grant date range (YYYY-MM-DD).
     */
    #[Optional]
    public ?string $grantDateTo;

    /**
     * Filter by inventor name.
     */
    #[Optional]
    public ?string $inventor;

    /**
     * Number of results to return (default 25, max 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Starting position for pagination.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Field to sort results by.
     *
     * @var value-of<SortBy>|null $sortBy
     */
    #[Optional(enum: SortBy::class)]
    public ?string $sortBy;

    /**
     * Sort order (default desc, newest first).
     *
     * @var value-of<SortOrder>|null $sortOrder
     */
    #[Optional(enum: SortOrder::class)]
    public ?string $sortOrder;

    /**
     * `new V1PatentSearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1PatentSearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1PatentSearchParams)->withQuery(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ApplicationType|value-of<ApplicationType>|null $applicationType
     * @param SortBy|value-of<SortBy>|null $sortBy
     * @param SortOrder|value-of<SortOrder>|null $sortOrder
     */
    public static function with(
        string $query,
        ?string $applicationStatus = null,
        ApplicationType|string|null $applicationType = null,
        ?string $assignee = null,
        ?string $filingDateFrom = null,
        ?string $filingDateTo = null,
        ?string $grantDateFrom = null,
        ?string $grantDateTo = null,
        ?string $inventor = null,
        ?int $limit = null,
        ?int $offset = null,
        SortBy|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $applicationStatus && $self['applicationStatus'] = $applicationStatus;
        null !== $applicationType && $self['applicationType'] = $applicationType;
        null !== $assignee && $self['assignee'] = $assignee;
        null !== $filingDateFrom && $self['filingDateFrom'] = $filingDateFrom;
        null !== $filingDateTo && $self['filingDateTo'] = $filingDateTo;
        null !== $grantDateFrom && $self['grantDateFrom'] = $grantDateFrom;
        null !== $grantDateTo && $self['grantDateTo'] = $grantDateTo;
        null !== $inventor && $self['inventor'] = $inventor;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $sortBy && $self['sortBy'] = $sortBy;
        null !== $sortOrder && $self['sortOrder'] = $sortOrder;

        return $self;
    }

    /**
     * Free-text search across all patent fields, or field-specific query (e.g. "applicationMetaData.patentNumber:11234567"). Supports AND, OR, NOT operators.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Filter by application status (e.g. "Patented Case", "Abandoned", "Pending").
     */
    public function withApplicationStatus(string $applicationStatus): self
    {
        $self = clone $this;
        $self['applicationStatus'] = $applicationStatus;

        return $self;
    }

    /**
     * Filter by application type.
     *
     * @param ApplicationType|value-of<ApplicationType> $applicationType
     */
    public function withApplicationType(
        ApplicationType|string $applicationType
    ): self {
        $self = clone $this;
        $self['applicationType'] = $applicationType;

        return $self;
    }

    /**
     * Filter by assignee/owner name (e.g. "Google LLC").
     */
    public function withAssignee(string $assignee): self
    {
        $self = clone $this;
        $self['assignee'] = $assignee;

        return $self;
    }

    /**
     * Start of filing date range (YYYY-MM-DD).
     */
    public function withFilingDateFrom(string $filingDateFrom): self
    {
        $self = clone $this;
        $self['filingDateFrom'] = $filingDateFrom;

        return $self;
    }

    /**
     * End of filing date range (YYYY-MM-DD).
     */
    public function withFilingDateTo(string $filingDateTo): self
    {
        $self = clone $this;
        $self['filingDateTo'] = $filingDateTo;

        return $self;
    }

    /**
     * Start of grant date range (YYYY-MM-DD).
     */
    public function withGrantDateFrom(string $grantDateFrom): self
    {
        $self = clone $this;
        $self['grantDateFrom'] = $grantDateFrom;

        return $self;
    }

    /**
     * End of grant date range (YYYY-MM-DD).
     */
    public function withGrantDateTo(string $grantDateTo): self
    {
        $self = clone $this;
        $self['grantDateTo'] = $grantDateTo;

        return $self;
    }

    /**
     * Filter by inventor name.
     */
    public function withInventor(string $inventor): self
    {
        $self = clone $this;
        $self['inventor'] = $inventor;

        return $self;
    }

    /**
     * Number of results to return (default 25, max 100).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Starting position for pagination.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Field to sort results by.
     *
     * @param SortBy|value-of<SortBy> $sortBy
     */
    public function withSortBy(SortBy|string $sortBy): self
    {
        $self = clone $this;
        $self['sortBy'] = $sortBy;

        return $self;
    }

    /**
     * Sort order (default desc, newest first).
     *
     * @param SortOrder|value-of<SortOrder> $sortOrder
     */
    public function withSortOrder(SortOrder|string $sortOrder): self
    {
        $self = clone $this;
        $self['sortOrder'] = $sortOrder;

        return $self;
    }
}
