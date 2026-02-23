<?php

declare(strict_types=1);

namespace Router\Vault\Graphrag\GraphragProcessObjectResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * Extraction statistics.
 *
 * @phpstan-type StatsShape = array{
 *   communityCount?: int|null,
 *   entityCount?: int|null,
 *   relationshipCount?: int|null,
 * }
 */
final class Stats implements BaseModel
{
    /** @use SdkModel<StatsShape> */
    use SdkModel;

    #[Optional('community_count')]
    public ?int $communityCount;

    #[Optional('entity_count')]
    public ?int $entityCount;

    #[Optional('relationship_count')]
    public ?int $relationshipCount;

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
        ?int $communityCount = null,
        ?int $entityCount = null,
        ?int $relationshipCount = null,
    ): self {
        $self = new self;

        null !== $communityCount && $self['communityCount'] = $communityCount;
        null !== $entityCount && $self['entityCount'] = $entityCount;
        null !== $relationshipCount && $self['relationshipCount'] = $relationshipCount;

        return $self;
    }

    public function withCommunityCount(int $communityCount): self
    {
        $self = clone $this;
        $self['communityCount'] = $communityCount;

        return $self;
    }

    public function withEntityCount(int $entityCount): self
    {
        $self = clone $this;
        $self['entityCount'] = $entityCount;

        return $self;
    }

    public function withRelationshipCount(int $relationshipCount): self
    {
        $self = clone $this;
        $self['relationshipCount'] = $relationshipCount;

        return $self;
    }
}
