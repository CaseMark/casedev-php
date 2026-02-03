<?php

declare(strict_types=1);

namespace Casedev\Applications\V1\Projects;

use Casedev\Applications\V1\Projects\ProjectListResponse\Project;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ProjectShape from \Casedev\Applications\V1\Projects\ProjectListResponse\Project
 *
 * @phpstan-type ProjectListResponseShape = array{
 *   projects?: list<Project|ProjectShape>|null
 * }
 */
final class ProjectListResponse implements BaseModel
{
    /** @use SdkModel<ProjectListResponseShape> */
    use SdkModel;

    /** @var list<Project>|null $projects */
    #[Optional(list: Project::class)]
    public ?array $projects;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Project|ProjectShape>|null $projects
     */
    public static function with(?array $projects = null): self
    {
        $self = new self;

        null !== $projects && $self['projects'] = $projects;

        return $self;
    }

    /**
     * @param list<Project|ProjectShape> $projects
     */
    public function withProjects(array $projects): self
    {
        $self = clone $this;
        $self['projects'] = $projects;

        return $self;
    }
}
