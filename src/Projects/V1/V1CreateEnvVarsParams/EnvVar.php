<?php

declare(strict_types=1);

namespace Casedev\Projects\V1\V1CreateEnvVarsParams;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Projects\V1\V1CreateEnvVarsParams\EnvVar\Environment;

/**
 * @phpstan-type EnvVarShape = array{
 *   environment: Environment|value-of<Environment>,
 *   key: string,
 *   value: string,
 *   description?: string|null,
 *   isSecret?: bool|null,
 * }
 */
final class EnvVar implements BaseModel
{
    /** @use SdkModel<EnvVarShape> */
    use SdkModel;

    /** @var value-of<Environment> $environment */
    #[Required(enum: Environment::class)]
    public string $environment;

    #[Required]
    public string $key;

    #[Required]
    public string $value;

    #[Optional]
    public ?string $description;

    #[Optional]
    public ?bool $isSecret;

    /**
     * `new EnvVar()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EnvVar::with(environment: ..., key: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EnvVar)->withEnvironment(...)->withKey(...)->withValue(...)
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
     * @param Environment|value-of<Environment> $environment
     */
    public static function with(
        Environment|string $environment,
        string $key,
        string $value,
        ?string $description = null,
        ?bool $isSecret = null,
    ): self {
        $self = new self;

        $self['environment'] = $environment;
        $self['key'] = $key;
        $self['value'] = $value;

        null !== $description && $self['description'] = $description;
        null !== $isSecret && $self['isSecret'] = $isSecret;

        return $self;
    }

    /**
     * @param Environment|value-of<Environment> $environment
     */
    public function withEnvironment(Environment|string $environment): self
    {
        $self = clone $this;
        $self['environment'] = $environment;

        return $self;
    }

    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }

    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withIsSecret(bool $isSecret): self
    {
        $self = clone $this;
        $self['isSecret'] = $isSecret;

        return $self;
    }
}
