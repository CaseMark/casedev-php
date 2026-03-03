<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1DocketResponse\Docket;
use CaseDev\Legal\V1\V1DocketResponse\Docket1;
use CaseDev\Legal\V1\V1DocketResponse\Entry;
use CaseDev\Legal\V1\V1DocketResponse\Pagination;
use CaseDev\Legal\V1\V1DocketResponse\Type;

/**
 * @phpstan-import-type DocketShape from \CaseDev\Legal\V1\V1DocketResponse\Docket
 * @phpstan-import-type Docket1Shape from \CaseDev\Legal\V1\V1DocketResponse\Docket1
 * @phpstan-import-type EntryShape from \CaseDev\Legal\V1\V1DocketResponse\Entry
 * @phpstan-import-type PaginationShape from \CaseDev\Legal\V1\V1DocketResponse\Pagination
 *
 * @phpstan-type V1DocketResponseShape = array{
 *   court?: string|null,
 *   dateFiledAfter?: string|null,
 *   dateFiledBefore?: string|null,
 *   docket?: null|Docket|DocketShape,
 *   dockets?: list<Docket1|Docket1Shape>|null,
 *   entries?: list<Entry|EntryShape>|null,
 *   found?: int|null,
 *   includeEntries?: bool|null,
 *   pagination?: null|Pagination|PaginationShape,
 *   query?: string|null,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class V1DocketResponse implements BaseModel
{
    /** @use SdkModel<V1DocketResponseShape> */
    use SdkModel;

    /**
     * Echo of court filter (search mode only).
     */
    #[Optional(nullable: true)]
    public ?string $court;

    /**
     * Echo of date filter.
     */
    #[Optional(nullable: true)]
    public ?string $dateFiledAfter;

    /**
     * Echo of date filter.
     */
    #[Optional(nullable: true)]
    public ?string $dateFiledBefore;

    /**
     * Full docket record (lookup mode).
     */
    #[Optional(nullable: true)]
    public ?Docket $docket;

    /**
     * Search results (search mode).
     *
     * @var list<Docket1>|null $dockets
     */
    #[Optional(list: Docket1::class)]
    public ?array $dockets;

    /**
     * Docket entries/filings (lookup mode with includeEntries).
     *
     * @var list<Entry>|null $entries
     */
    #[Optional(list: Entry::class, nullable: true)]
    public ?array $entries;

    #[Optional]
    public ?int $found;

    /**
     * Whether entries were requested (lookup mode only).
     */
    #[Optional]
    public ?bool $includeEntries;

    /**
     * Pagination info for entry list (lookup mode with includeEntries).
     */
    #[Optional(nullable: true)]
    public ?Pagination $pagination;

    /**
     * Echo of search query (search mode only).
     */
    #[Optional(nullable: true)]
    public ?string $query;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class)]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Docket|DocketShape|null $docket
     * @param list<Docket1|Docket1Shape>|null $dockets
     * @param list<Entry|EntryShape>|null $entries
     * @param Pagination|PaginationShape|null $pagination
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?string $court = null,
        ?string $dateFiledAfter = null,
        ?string $dateFiledBefore = null,
        Docket|array|null $docket = null,
        ?array $dockets = null,
        ?array $entries = null,
        ?int $found = null,
        ?bool $includeEntries = null,
        Pagination|array|null $pagination = null,
        ?string $query = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        null !== $court && $self['court'] = $court;
        null !== $dateFiledAfter && $self['dateFiledAfter'] = $dateFiledAfter;
        null !== $dateFiledBefore && $self['dateFiledBefore'] = $dateFiledBefore;
        null !== $docket && $self['docket'] = $docket;
        null !== $dockets && $self['dockets'] = $dockets;
        null !== $entries && $self['entries'] = $entries;
        null !== $found && $self['found'] = $found;
        null !== $includeEntries && $self['includeEntries'] = $includeEntries;
        null !== $pagination && $self['pagination'] = $pagination;
        null !== $query && $self['query'] = $query;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Echo of court filter (search mode only).
     */
    public function withCourt(?string $court): self
    {
        $self = clone $this;
        $self['court'] = $court;

        return $self;
    }

    /**
     * Echo of date filter.
     */
    public function withDateFiledAfter(?string $dateFiledAfter): self
    {
        $self = clone $this;
        $self['dateFiledAfter'] = $dateFiledAfter;

        return $self;
    }

    /**
     * Echo of date filter.
     */
    public function withDateFiledBefore(?string $dateFiledBefore): self
    {
        $self = clone $this;
        $self['dateFiledBefore'] = $dateFiledBefore;

        return $self;
    }

    /**
     * Full docket record (lookup mode).
     *
     * @param Docket|DocketShape|null $docket
     */
    public function withDocket(Docket|array|null $docket): self
    {
        $self = clone $this;
        $self['docket'] = $docket;

        return $self;
    }

    /**
     * Search results (search mode).
     *
     * @param list<Docket1|Docket1Shape> $dockets
     */
    public function withDockets(array $dockets): self
    {
        $self = clone $this;
        $self['dockets'] = $dockets;

        return $self;
    }

    /**
     * Docket entries/filings (lookup mode with includeEntries).
     *
     * @param list<Entry|EntryShape>|null $entries
     */
    public function withEntries(?array $entries): self
    {
        $self = clone $this;
        $self['entries'] = $entries;

        return $self;
    }

    public function withFound(int $found): self
    {
        $self = clone $this;
        $self['found'] = $found;

        return $self;
    }

    /**
     * Whether entries were requested (lookup mode only).
     */
    public function withIncludeEntries(bool $includeEntries): self
    {
        $self = clone $this;
        $self['includeEntries'] = $includeEntries;

        return $self;
    }

    /**
     * Pagination info for entry list (lookup mode with includeEntries).
     *
     * @param Pagination|PaginationShape|null $pagination
     */
    public function withPagination(Pagination|array|null $pagination): self
    {
        $self = clone $this;
        $self['pagination'] = $pagination;

        return $self;
    }

    /**
     * Echo of search query (search mode only).
     */
    public function withQuery(?string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
