<?php

declare(strict_types=1);

namespace Router\Database\V1\Projects;

use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProjectNewBranchResponseShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   isDefault: bool,
 *   name: string,
 *   parentBranchID: string|null,
 *   status: string,
 * }
 */
final class ProjectNewBranchResponse implements BaseModel
{
    /** @use SdkModel<ProjectNewBranchResponseShape> */
    use SdkModel;

    /**
     * Branch ID.
     */
    #[Required]
    public string $id;

    /**
     * Branch creation timestamp.
     */
    #[Required]
    public \DateTimeInterface $createdAt;

    /**
     * Whether this is the default branch (always false for new branches).
     */
    #[Required]
    public bool $isDefault;

    /**
     * Branch name.
     */
    #[Required]
    public string $name;

    /**
     * Parent branch ID.
     */
    #[Required('parentBranchId')]
    public ?string $parentBranchID;

    /**
     * Branch status.
     */
    #[Required]
    public string $status;

    /**
     * `new ProjectNewBranchResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectNewBranchResponse::with(
     *   id: ...,
     *   createdAt: ...,
     *   isDefault: ...,
     *   name: ...,
     *   parentBranchID: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectNewBranchResponse)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withIsDefault(...)
     *   ->withName(...)
     *   ->withParentBranchID(...)
     *   ->withStatus(...)
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
        string $id,
        \DateTimeInterface $createdAt,
        bool $isDefault,
        string $name,
        ?string $parentBranchID,
        string $status,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['isDefault'] = $isDefault;
        $self['name'] = $name;
        $self['parentBranchID'] = $parentBranchID;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Branch ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Branch creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Whether this is the default branch (always false for new branches).
     */
    public function withIsDefault(bool $isDefault): self
    {
        $self = clone $this;
        $self['isDefault'] = $isDefault;

        return $self;
    }

    /**
     * Branch name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Parent branch ID.
     */
    public function withParentBranchID(?string $parentBranchID): self
    {
        $self = clone $this;
        $self['parentBranchID'] = $parentBranchID;

        return $self;
    }

    /**
     * Branch status.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
