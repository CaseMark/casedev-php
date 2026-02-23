<?php

declare(strict_types=1);

namespace Router\Database\V1\Projects\ProjectGetResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type DatabaseShape = array{
 *   id?: string|null, name?: string|null, ownerName?: string|null
 * }
 */
final class Database implements BaseModel
{
    /** @use SdkModel<DatabaseShape> */
    use SdkModel;

    /**
     * Database ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * Database name.
     */
    #[Optional]
    public ?string $name;

    /**
     * Database owner role name.
     */
    #[Optional]
    public ?string $ownerName;

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
        ?string $name = null,
        ?string $ownerName = null
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $name && $self['name'] = $name;
        null !== $ownerName && $self['ownerName'] = $ownerName;

        return $self;
    }

    /**
     * Database ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Database name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Database owner role name.
     */
    public function withOwnerName(string $ownerName): self
    {
        $self = clone $this;
        $self['ownerName'] = $ownerName;

        return $self;
    }
}
