<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Projects;

use CaseDev\Applications\V1\Projects\ProjectCreateDeploymentParams\EnvironmentVariable;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Trigger a new deployment for a project.
 *
 * @see CaseDev\Services\Applications\V1\ProjectsService::createDeployment()
 *
 * @phpstan-import-type EnvironmentVariableShape from \CaseDev\Applications\V1\Projects\ProjectCreateDeploymentParams\EnvironmentVariable
 *
 * @phpstan-type ProjectCreateDeploymentParamsShape = array{
 *   environmentVariables?: list<EnvironmentVariable|EnvironmentVariableShape>|null
 * }
 */
final class ProjectCreateDeploymentParams implements BaseModel
{
    /** @use SdkModel<ProjectCreateDeploymentParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Additional environment variables to set or update before deployment.
     *
     * @var list<EnvironmentVariable>|null $environmentVariables
     */
    #[Optional(list: EnvironmentVariable::class)]
    public ?array $environmentVariables;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<EnvironmentVariable|EnvironmentVariableShape>|null $environmentVariables
     */
    public static function with(?array $environmentVariables = null): self
    {
        $self = new self;

        null !== $environmentVariables && $self['environmentVariables'] = $environmentVariables;

        return $self;
    }

    /**
     * Additional environment variables to set or update before deployment.
     *
     * @param list<EnvironmentVariable|EnvironmentVariableShape> $environmentVariables
     */
    public function withEnvironmentVariables(array $environmentVariables): self
    {
        $self = clone $this;
        $self['environmentVariables'] = $environmentVariables;

        return $self;
    }
}
