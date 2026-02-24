<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Projects;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Delete an environment variable from a project.
 *
 * @see CaseDev\Services\Applications\V1\ProjectsService::deleteEnv()
 *
 * @phpstan-type ProjectDeleteEnvParamsShape = array{id: string}
 */
final class ProjectDeleteEnvParams implements BaseModel
{
    /** @use SdkModel<ProjectDeleteEnvParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new ProjectDeleteEnvParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectDeleteEnvParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectDeleteEnvParams)->withID(...)
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
     */
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
