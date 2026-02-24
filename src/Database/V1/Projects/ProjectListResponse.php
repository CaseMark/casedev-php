<?php

declare(strict_types=1);

namespace CaseDev\Database\V1\Projects;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Database\V1\Projects\ProjectListResponse\Project;

/**
 * @phpstan-import-type ProjectShape from \CaseDev\Database\V1\Projects\ProjectListResponse\Project
 *
 * @phpstan-type ProjectListResponseShape = array{
 *   projects: list<Project|ProjectShape>
 * }
 */
final class ProjectListResponse implements BaseModel
{
    /** @use SdkModel<ProjectListResponseShape> */
    use SdkModel;

    /** @var list<Project> $projects */
    #[Required(list: Project::class)]
    public array $projects;

    /**
     * `new ProjectListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectListResponse::with(projects: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectListResponse)->withProjects(...)
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
     * @param list<Project|ProjectShape> $projects
     */
    public static function with(array $projects): self
    {
        $self = new self;

        $self['projects'] = $projects;

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
