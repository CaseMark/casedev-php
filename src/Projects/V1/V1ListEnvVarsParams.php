<?php

declare(strict_types=1);

namespace Casedev\Projects\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Projects\V1\V1ListEnvVarsParams\Environment;

/**
 * List all environment variables for a project, grouped by environment.
 *
 * @see Casedev\Services\Projects\V1Service::listEnvVars()
 *
 * @phpstan-type V1ListEnvVarsParamsShape = array{
 *   environment?: null|Environment|value-of<Environment>
 * }
 */
final class V1ListEnvVarsParams implements BaseModel
{
    /** @use SdkModel<V1ListEnvVarsParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var value-of<Environment>|null $environment */
    #[Optional(enum: Environment::class)]
    public ?string $environment;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Environment|value-of<Environment>|null $environment
     */
    public static function with(Environment|string|null $environment = null): self
    {
        $self = new self;

        null !== $environment && $self['environment'] = $environment;

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
}
