<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Returns court IDs (slugs) and names for use with the docket search endpoint. Use the returned court ID as the `court` parameter in legal.docket().
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
     * Only return courts with available docket data.
     */
    #[Optional]
    public ?bool $inUseOnly;

    /**
     * Optional jurisdiction code filter (e.g. FD for Federal District, F for all Federal, S for State).
     */
    #[Optional]
    public ?string $jurisdiction;

    /**
     * Maximum number of courts to return.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Number of courts to skip before returning results.
     */
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
     * Only return courts with available docket data.
     */
    public function withInUseOnly(bool $inUseOnly): self
    {
        $self = clone $this;
        $self['inUseOnly'] = $inUseOnly;

        return $self;
    }

    /**
     * Optional jurisdiction code filter (e.g. FD for Federal District, F for all Federal, S for State).
     */
    public function withJurisdiction(string $jurisdiction): self
    {
        $self = clone $this;
        $self['jurisdiction'] = $jurisdiction;

        return $self;
    }

    /**
     * Maximum number of courts to return.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Number of courts to skip before returning results.
     */
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
