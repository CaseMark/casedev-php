<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1\V1ListResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type WorkflowShape = array{
 *   id?: string|null,
 *   createdAt?: string|null,
 *   deployedAt?: string|null,
 *   description?: string|null,
 *   name?: string|null,
 *   triggerType?: string|null,
 *   updatedAt?: string|null,
 *   visibility?: string|null,
 * }
 */
final class Workflow implements BaseModel
{
    /** @use SdkModel<WorkflowShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?string $createdAt;

    #[Optional]
    public ?string $deployedAt;

    #[Optional]
    public ?string $description;

    #[Optional]
    public ?string $name;

    #[Optional]
    public ?string $triggerType;

    #[Optional]
    public ?string $updatedAt;

    #[Optional]
    public ?string $visibility;

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
        ?string $createdAt = null,
        ?string $deployedAt = null,
        ?string $description = null,
        ?string $name = null,
        ?string $triggerType = null,
        ?string $updatedAt = null,
        ?string $visibility = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $deployedAt && $self['deployedAt'] = $deployedAt;
        null !== $description && $self['description'] = $description;
        null !== $name && $self['name'] = $name;
        null !== $triggerType && $self['triggerType'] = $triggerType;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;
        null !== $visibility && $self['visibility'] = $visibility;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withDeployedAt(string $deployedAt): self
    {
        $self = clone $this;
        $self['deployedAt'] = $deployedAt;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withTriggerType(string $triggerType): self
    {
        $self = clone $this;
        $self['triggerType'] = $triggerType;

        return $self;
    }

    public function withUpdatedAt(string $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withVisibility(string $visibility): self
    {
        $self = clone $this;
        $self['visibility'] = $visibility;

        return $self;
    }
}
