<?php

declare(strict_types=1);

namespace Router\Applications\V1\Projects\ProjectCreateParams;

use Router\Applications\V1\Projects\ProjectCreateParams\EnvironmentVariable\Target;
use Router\Applications\V1\Projects\ProjectCreateParams\EnvironmentVariable\Type;
use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type EnvironmentVariableShape = array{
 *   key: string,
 *   target: list<Target|value-of<Target>>,
 *   value: string,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class EnvironmentVariable implements BaseModel
{
    /** @use SdkModel<EnvironmentVariableShape> */
    use SdkModel;

    /**
     * Environment variable name.
     */
    #[Required]
    public string $key;

    /**
     * Deployment targets for this variable.
     *
     * @var list<value-of<Target>> $target
     */
    #[Required(list: Target::class)]
    public array $target;

    /**
     * Environment variable value.
     */
    #[Required]
    public string $value;

    /**
     * Variable type.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new EnvironmentVariable()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EnvironmentVariable::with(key: ..., target: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EnvironmentVariable)->withKey(...)->withTarget(...)->withValue(...)
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
     * @param list<Target|value-of<Target>> $target
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $key,
        array $target,
        string $value,
        Type|string|null $type = null
    ): self {
        $self = new self;

        $self['key'] = $key;
        $self['target'] = $target;
        $self['value'] = $value;

        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Environment variable name.
     */
    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }

    /**
     * Deployment targets for this variable.
     *
     * @param list<Target|value-of<Target>> $target
     */
    public function withTarget(array $target): self
    {
        $self = clone $this;
        $self['target'] = $target;

        return $self;
    }

    /**
     * Environment variable value.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }

    /**
     * Variable type.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
