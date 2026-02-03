<?php

declare(strict_types=1);

namespace Casedev\Projects\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Projects\V1\V1ListResponse\Project;

/**
 * @phpstan-import-type ProjectShape from \Casedev\Projects\V1\V1ListResponse\Project
 *
 * @phpstan-type V1ListResponseShape = array{
 *   projects?: list<Project|ProjectShape>|null
 * }
 */
final class V1ListResponse implements BaseModel
{
    /** @use SdkModel<V1ListResponseShape> */
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
