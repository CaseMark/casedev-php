<?php

declare(strict_types=1);

namespace Casedev\Database\V1\Projects\ProjectGetResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Database\V1\Projects\ProjectGetResponse\LinkedDeployment\Type;

/**
 * @phpstan-type LinkedDeploymentShape = array{
 *   id?: string|null,
 *   envVarName?: string|null,
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
     * Environment variable name for connection string.
     */
    #[Optional]
    public ?string $envVarName;

    /**
     * Deployment name.
     */
    #[Optional]
    public ?string $name;

    /**
     * Deployment type.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * Deployment URL.
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
        ?string $envVarName = null,
        ?string $name = null,
        Type|string|null $type = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $envVarName && $self['envVarName'] = $envVarName;
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
     * Environment variable name for connection string.
     */
    public function withEnvVarName(string $envVarName): self
    {
        $self = clone $this;
        $self['envVarName'] = $envVarName;

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
     * Deployment type.
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
     * Deployment URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
