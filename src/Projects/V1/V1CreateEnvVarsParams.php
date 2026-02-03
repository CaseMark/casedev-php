<?php

declare(strict_types=1);

namespace Casedev\Projects\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Projects\V1\V1CreateEnvVarsParams\EnvVar;

/**
 * Create or update environment variables for a project.
 *
 * @see Casedev\Services\Projects\V1Service::createEnvVars()
 *
 * @phpstan-import-type EnvVarShape from \Casedev\Projects\V1\V1CreateEnvVarsParams\EnvVar
 *
 * @phpstan-type V1CreateEnvVarsParamsShape = array{
 *   envVars?: list<EnvVar|EnvVarShape>|null
 * }
 */
final class V1CreateEnvVarsParams implements BaseModel
{
    /** @use SdkModel<V1CreateEnvVarsParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var list<EnvVar>|null $envVars */
    #[Optional(list: EnvVar::class)]
    public ?array $envVars;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<EnvVar|EnvVarShape>|null $envVars
     */
    public static function with(?array $envVars = null): self
    {
        $self = new self;

        null !== $envVars && $self['envVars'] = $envVars;

        return $self;
    }

    /**
     * @param list<EnvVar|EnvVarShape> $envVars
     */
    public function withEnvVars(array $envVars): self
    {
        $self = clone $this;
        $self['envVars'] = $envVars;

        return $self;
    }
}
