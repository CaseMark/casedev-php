<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1DocketParams\Type;

/**
 * Search federal court dockets or retrieve a specific docket with optional filing entries. Use legal.listCourts() to resolve court slugs for filtering.
 *
 * @see CaseDev\Services\Legal\V1Service::docket()
 *
 * @phpstan-type V1DocketParamsShape = array{
 *   type: Type|value-of<Type>,
 *   acknowledgePacerFees?: bool|null,
 *   court?: string|null,
 *   dateFiledAfter?: string|null,
 *   dateFiledBefore?: string|null,
 *   docketID?: string|null,
 *   includeEntries?: bool|null,
 *   limit?: int|null,
 *   live?: bool|null,
 *   offset?: int|null,
 *   query?: string|null,
 * }
 */
final class V1DocketParams implements BaseModel
{
    /** @use SdkModel<V1DocketParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Search dockets or look up a docket by ID.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Required when live: true. Acknowledges that PACER fees (up to $3.00 per docket) plus a $0.05 service fee will be charged to your account.
     */
    #[Optional]
    public ?bool $acknowledgePacerFees;

    /**
     * Optional court slug for filtering (e.g. "nysd", "ca9", "cafc"). Use legal.listCourts() to find slugs.
     */
    #[Optional]
    public ?string $court;

    /**
     * Optional lower bound for filing date (YYYY-MM-DD).
     */
    #[Optional]
    public ?string $dateFiledAfter;

    /**
     * Optional upper bound for filing date (YYYY-MM-DD).
     */
    #[Optional]
    public ?string $dateFiledBefore;

    /**
     * Docket ID (required for lookup).
     */
    #[Optional('docketId')]
    public ?string $docketID;

    /**
     * Include docket entries/filings in lookup responses. Coming soon — currently returns 501. The parameter is accepted for forward compatibility.
     */
    #[Optional]
    public ?bool $includeEntries;

    /**
     * Page size for search results or entry list (default 25 for search, 50 for lookup).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Trigger a live PACER fetch for dockets not yet in the RECAP archive. Requires acknowledgePacerFees: true. PACER charges up to $3.00 per docket sheet plus a $0.05 service fee. Only valid with type: "lookup".
     */
    #[Optional]
    public ?bool $live;

    /**
     * Offset for search results or entry list.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Case name or party name search query (required for search).
     */
    #[Optional]
    public ?string $query;

    /**
     * `new V1DocketParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1DocketParams::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1DocketParams)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        Type|string $type,
        ?bool $acknowledgePacerFees = null,
        ?string $court = null,
        ?string $dateFiledAfter = null,
        ?string $dateFiledBefore = null,
        ?string $docketID = null,
        ?bool $includeEntries = null,
        ?int $limit = null,
        ?bool $live = null,
        ?int $offset = null,
        ?string $query = null,
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $acknowledgePacerFees && $self['acknowledgePacerFees'] = $acknowledgePacerFees;
        null !== $court && $self['court'] = $court;
        null !== $dateFiledAfter && $self['dateFiledAfter'] = $dateFiledAfter;
        null !== $dateFiledBefore && $self['dateFiledBefore'] = $dateFiledBefore;
        null !== $docketID && $self['docketID'] = $docketID;
        null !== $includeEntries && $self['includeEntries'] = $includeEntries;
        null !== $limit && $self['limit'] = $limit;
        null !== $live && $self['live'] = $live;
        null !== $offset && $self['offset'] = $offset;
        null !== $query && $self['query'] = $query;

        return $self;
    }

    /**
     * Search dockets or look up a docket by ID.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Required when live: true. Acknowledges that PACER fees (up to $3.00 per docket) plus a $0.05 service fee will be charged to your account.
     */
    public function withAcknowledgePacerFees(bool $acknowledgePacerFees): self
    {
        $self = clone $this;
        $self['acknowledgePacerFees'] = $acknowledgePacerFees;

        return $self;
    }

    /**
     * Optional court slug for filtering (e.g. "nysd", "ca9", "cafc"). Use legal.listCourts() to find slugs.
     */
    public function withCourt(string $court): self
    {
        $self = clone $this;
        $self['court'] = $court;

        return $self;
    }

    /**
     * Optional lower bound for filing date (YYYY-MM-DD).
     */
    public function withDateFiledAfter(string $dateFiledAfter): self
    {
        $self = clone $this;
        $self['dateFiledAfter'] = $dateFiledAfter;

        return $self;
    }

    /**
     * Optional upper bound for filing date (YYYY-MM-DD).
     */
    public function withDateFiledBefore(string $dateFiledBefore): self
    {
        $self = clone $this;
        $self['dateFiledBefore'] = $dateFiledBefore;

        return $self;
    }

    /**
     * Docket ID (required for lookup).
     */
    public function withDocketID(string $docketID): self
    {
        $self = clone $this;
        $self['docketID'] = $docketID;

        return $self;
    }

    /**
     * Include docket entries/filings in lookup responses. Coming soon — currently returns 501. The parameter is accepted for forward compatibility.
     */
    public function withIncludeEntries(bool $includeEntries): self
    {
        $self = clone $this;
        $self['includeEntries'] = $includeEntries;

        return $self;
    }

    /**
     * Page size for search results or entry list (default 25 for search, 50 for lookup).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Trigger a live PACER fetch for dockets not yet in the RECAP archive. Requires acknowledgePacerFees: true. PACER charges up to $3.00 per docket sheet plus a $0.05 service fee. Only valid with type: "lookup".
     */
    public function withLive(bool $live): self
    {
        $self = clone $this;
        $self['live'] = $live;

        return $self;
    }

    /**
     * Offset for search results or entry list.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Case name or party name search query (required for search).
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }
}
