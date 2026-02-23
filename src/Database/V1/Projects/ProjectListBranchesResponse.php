<?php

declare(strict_types=1);

namespace Router\Database\V1\Projects;

use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Database\V1\Projects\ProjectListBranchesResponse\Branch;

/**
 * @phpstan-import-type BranchShape from \Router\Database\V1\Projects\ProjectListBranchesResponse\Branch
 *
 * @phpstan-type ProjectListBranchesResponseShape = array{
 *   branches: list<Branch|BranchShape>
 * }
 */
final class ProjectListBranchesResponse implements BaseModel
{
    /** @use SdkModel<ProjectListBranchesResponseShape> */
    use SdkModel;

    /** @var list<Branch> $branches */
    #[Required(list: Branch::class)]
    public array $branches;

    /**
     * `new ProjectListBranchesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectListBranchesResponse::with(branches: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectListBranchesResponse)->withBranches(...)
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
     * @param list<Branch|BranchShape> $branches
     */
    public static function with(array $branches): self
    {
        $self = new self;

        $self['branches'] = $branches;

        return $self;
    }

    /**
     * @param list<Branch|BranchShape> $branches
     */
    public function withBranches(array $branches): self
    {
        $self = clone $this;
        $self['branches'] = $branches;

        return $self;
    }
}
