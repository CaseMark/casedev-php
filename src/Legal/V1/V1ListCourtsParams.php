<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Returns CourtListener court IDs and names for docket filtering. Use these IDs in legal.docket() as the court parameter.
 *
 * @see CaseDev\Services\Legal\V1Service::listCourts()
 *
 * @phpstan-type V1ListCourtsParamsShape = array{
 *   inUseOnly?: bool|null,
 *   jurisdiction?: string|null,
 *   limit?: int|null,
 *   offset?: int|null,
 *   query?: string|null,
 * }
 */
final class V1ListCourtsParams implements BaseModel
{
    /** @use SdkModel<V1ListCourtsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Only return courts currently in use by CourtListener.
     */
    #[Optional]
    public ?bool $inUseOnly;

    /**
     * Optional CourtListener jurisdiction code filter (e.g. FD, F, S).
     */
    #[Optional]
    public ?string $jurisdiction;

    #[Optional]
    public ?int $limit;

    #[Optional]
    public ?int $offset;

    /**
     * Search by court name or slug (e.g. "Northern District", "nysd", "ca9").
     */
    #[Optional]
    public ?string $query;

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
        ?bool $inUseOnly = null,
        ?string $jurisdiction = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $query = null,
    ): self {
        $self = new self;

        null !== $inUseOnly && $self['inUseOnly'] = $inUseOnly;
        null !== $jurisdiction && $self['jurisdiction'] = $jurisdiction;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $query && $self['query'] = $query;

        return $self;
    }

    /**
     * Only return courts currently in use by CourtListener.
     */
    public function withInUseOnly(bool $inUseOnly): self
    {
        $self = clone $this;
        $self['inUseOnly'] = $inUseOnly;

        return $self;
    }

    /**
     * Optional CourtListener jurisdiction code filter (e.g. FD, F, S).
     */
    public function withJurisdiction(string $jurisdiction): self
    {
        $self = clone $this;
        $self['jurisdiction'] = $jurisdiction;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Search by court name or slug (e.g. "Northern District", "nysd", "ca9").
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }
}
