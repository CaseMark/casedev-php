<?php

declare(strict_types=1);

namespace Casedev\Database\V1\Projects;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Creates a new branch from the specified parent branch (or default 'main' branch). Branches provide instant point-in-time clones of your database for isolated development, staging, testing, or feature work. Perfect for testing schema changes, running migrations safely, or creating ephemeral preview environments.
 *
 * @see Casedev\Services\Database\V1\ProjectsService::createBranch()
 *
 * @phpstan-type ProjectCreateBranchParamsShape = array{
 *   name: string, parentBranchID?: string|null
 * }
 */
final class ProjectCreateBranchParams implements BaseModel
{
    /** @use SdkModel<ProjectCreateBranchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Branch name (letters, numbers, hyphens, underscores only).
     */
    #[Required]
    public string $name;

    /**
     * Parent branch ID to clone from (defaults to main branch).
     */
    #[Optional('parentBranchId')]
    public ?string $parentBranchID;

    /**
     * `new ProjectCreateBranchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectCreateBranchParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectCreateBranchParams)->withName(...)
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
    public static function with(
        string $name,
        ?string $parentBranchID = null
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $parentBranchID && $self['parentBranchID'] = $parentBranchID;

        return $self;
    }

    /**
     * Branch name (letters, numbers, hyphens, underscores only).
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Parent branch ID to clone from (defaults to main branch).
     */
    public function withParentBranchID(string $parentBranchID): self
    {
        $self = clone $this;
        $self['parentBranchID'] = $parentBranchID;

        return $self;
    }
}
