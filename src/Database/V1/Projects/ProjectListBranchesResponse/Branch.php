<?php

declare(strict_types=1);

namespace Router\Database\V1\Projects\ProjectListBranchesResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type BranchShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   isDefault?: bool|null,
 *   name?: string|null,
 *   parentBranchID?: string|null,
 *   status?: string|null,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class Branch implements BaseModel
{
    /** @use SdkModel<BranchShape> */
    use SdkModel;

    /**
     * Branch ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * Branch creation timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * Whether this is the default branch.
     */
    #[Optional]
    public ?bool $isDefault;

    /**
     * Branch name.
     */
    #[Optional]
    public ?string $name;

    /**
     * Parent branch ID (null for default branch).
     */
    #[Optional('parentBranchId', nullable: true)]
    public ?string $parentBranchID;

    /**
     * Branch status.
     */
    #[Optional]
    public ?string $status;

    /**
     * Branch last update timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $updatedAt;

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
        ?string $id = null,
        ?\DateTimeInterface $createdAt = null,
        ?bool $isDefault = null,
        ?string $name = null,
        ?string $parentBranchID = null,
        ?string $status = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $isDefault && $self['isDefault'] = $isDefault;
        null !== $name && $self['name'] = $name;
        null !== $parentBranchID && $self['parentBranchID'] = $parentBranchID;
        null !== $status && $self['status'] = $status;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

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
     * Whether this is the default branch.
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
     * Parent branch ID (null for default branch).
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

    /**
     * Branch last update timestamp.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
