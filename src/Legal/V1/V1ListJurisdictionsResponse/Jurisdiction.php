<?php

declare(strict_types=1);

namespace Router\Legal\V1\V1ListJurisdictionsResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Legal\V1\V1ListJurisdictionsResponse\Jurisdiction\Level;

/**
 * @phpstan-type JurisdictionShape = array{
 *   id?: string|null,
 *   level?: null|Level|value-of<Level>,
 *   name?: string|null,
 *   state?: string|null,
 * }
 */
final class Jurisdiction implements BaseModel
{
    /** @use SdkModel<JurisdictionShape> */
    use SdkModel;

    /**
     * Jurisdiction ID to use in other endpoints.
     */
    #[Optional]
    public ?string $id;

    /**
     * Jurisdiction level.
     *
     * @var value-of<Level>|null $level
     */
    #[Optional(enum: Level::class)]
    public ?string $level;

    /**
     * Full jurisdiction name.
     */
    #[Optional]
    public ?string $name;

    /**
     * State abbreviation (if applicable).
     */
    #[Optional(nullable: true)]
    public ?string $state;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Level|value-of<Level>|null $level
     */
    public static function with(
        ?string $id = null,
        Level|string|null $level = null,
        ?string $name = null,
        ?string $state = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $level && $self['level'] = $level;
        null !== $name && $self['name'] = $name;
        null !== $state && $self['state'] = $state;

        return $self;
    }

    /**
     * Jurisdiction ID to use in other endpoints.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Jurisdiction level.
     *
     * @param Level|value-of<Level> $level
     */
    public function withLevel(Level|string $level): self
    {
        $self = clone $this;
        $self['level'] = $level;

        return $self;
    }

    /**
     * Full jurisdiction name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * State abbreviation (if applicable).
     */
    public function withState(?string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
