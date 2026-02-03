<?php

declare(strict_types=1);

namespace Casedev\Database\V1\Projects\ProjectGetResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type BranchShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   isDefault?: bool|null,
 *   name?: string|null,
 *   status?: string|null,
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
     * Branch status.
     */
    #[Optional]
    public ?string $status;

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
        ?string $status = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $isDefault && $self['isDefault'] = $isDefault;
        null !== $name && $self['name'] = $name;
        null !== $status && $self['status'] = $status;

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
     * Branch status.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
