<?php

declare(strict_types=1);

namespace Router\Database\V1\Projects\ProjectListResponse\Project;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Database\V1\Projects\ProjectListResponse\Project\LinkedDeployment\Type;

/**
 * @phpstan-type LinkedDeploymentShape = array{
 *   id?: string|null,
 *   name?: string|null,
 *   type?: null|Type|value-of<Type>,
 *   url?: string|null,
 * }
 */
final class LinkedDeployment implements BaseModel
{
    /** @use SdkModel<LinkedDeploymentShape> */
    use SdkModel;

    /**
     * Deployment ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * Deployment name.
     */
    #[Optional]
    public ?string $name;

    /**
     * Type of deployment.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * Deployment URL (for Thurgood apps).
     */
    #[Optional]
    public ?string $url;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?string $id = null,
        ?string $name = null,
        Type|string|null $type = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $name && $self['name'] = $name;
        null !== $type && $self['type'] = $type;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Deployment ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Deployment name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Type of deployment.
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
     * Deployment URL (for Thurgood apps).
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
