<?php

declare(strict_types=1);

namespace Router\Applications\V1\Projects;

use Router\Applications\V1\Projects\ProjectCreateEnvParams\Target;
use Router\Applications\V1\Projects\ProjectCreateEnvParams\Type;
use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Create a new environment variable for a project.
 *
 * @see Router\Services\Applications\V1\ProjectsService::createEnv()
 *
 * @phpstan-type ProjectCreateEnvParamsShape = array{
 *   key: string,
 *   target: list<Target|value-of<Target>>,
 *   value: string,
 *   gitBranch?: string|null,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class ProjectCreateEnvParams implements BaseModel
{
    /** @use SdkModel<ProjectCreateEnvParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * Specific git branch (for preview deployments).
     */
    #[Optional]
    public ?string $gitBranch;

    /**
     * Variable type.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new ProjectCreateEnvParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectCreateEnvParams::with(key: ..., target: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectCreateEnvParams)->withKey(...)->withTarget(...)->withValue(...)
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
        ?string $gitBranch = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        $self['key'] = $key;
        $self['target'] = $target;
        $self['value'] = $value;

        null !== $gitBranch && $self['gitBranch'] = $gitBranch;
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
     * Specific git branch (for preview deployments).
     */
    public function withGitBranch(string $gitBranch): self
    {
        $self = clone $this;
        $self['gitBranch'] = $gitBranch;

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
