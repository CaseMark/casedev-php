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
        $obj = new self;

        null !== $id && $obj['id'] = $id;
        null !== $createdAt && $obj['createdAt'] = $createdAt;
        null !== $deployedAt && $obj['deployedAt'] = $deployedAt;
        null !== $description && $obj['description'] = $description;
        null !== $name && $obj['name'] = $name;
        null !== $triggerType && $obj['triggerType'] = $triggerType;
        null !== $updatedAt && $obj['updatedAt'] = $updatedAt;
        null !== $visibility && $obj['visibility'] = $visibility;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    public function withCreatedAt(string $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    public function withDeployedAt(string $deployedAt): self
    {
        $obj = clone $this;
        $obj['deployedAt'] = $deployedAt;

        return $obj;
    }

    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    public function withTriggerType(string $triggerType): self
    {
        $obj = clone $this;
        $obj['triggerType'] = $triggerType;

        return $obj;
    }

    public function withUpdatedAt(string $updatedAt): self
    {
        $obj = clone $this;
        $obj['updatedAt'] = $updatedAt;

        return $obj;
    }

    public function withVisibility(string $visibility): self
    {
        $obj = clone $this;
        $obj['visibility'] = $visibility;

        return $obj;
    }
}
