<?php

declare(strict_types=1);

namespace Casedev\Applications\V1\Projects;

use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Remove a domain from a project.
 *
 * @see Casedev\Services\Applications\V1\ProjectsService::deleteDomain()
 *
 * @phpstan-type ProjectDeleteDomainParamsShape = array{id: string}
 */
final class ProjectDeleteDomainParams implements BaseModel
{
    /** @use SdkModel<ProjectDeleteDomainParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new ProjectDeleteDomainParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectDeleteDomainParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectDeleteDomainParams)->withID(...)
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
