<?php

declare(strict_types=1);

namespace Router\Legal\V1\V1GetCitationsFromURLResponse\Citations;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type StatuteShape = array{
 *   citation?: string|null, count?: int|null, type?: string|null
 * }
 */
final class Statute implements BaseModel
{
    /** @use SdkModel<StatuteShape> */
    use SdkModel;

    /**
     * The citation string.
     */
    #[Optional]
    public ?string $citation;

    /**
     * Number of occurrences.
     */
    #[Optional]
    public ?int $count;

    /**
     * Citation type (usc).
     */
    #[Optional]
    public ?string $type;

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
        ?string $citation = null,
        ?int $count = null,
        ?string $type = null
    ): self {
        $self = new self;

        null !== $citation && $self['citation'] = $citation;
        null !== $count && $self['count'] = $count;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * The citation string.
     */
    public function withCitation(string $citation): self
    {
        $self = clone $this;
        $self['citation'] = $citation;

        return $self;
    }

    /**
     * Number of occurrences.
     */
    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    /**
     * Citation type (usc).
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
