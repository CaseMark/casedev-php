<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type V1GetResponseShape = array{
 *   id?: string|null,
 *   createdAt?: string|null,
 *   deployedAt?: string|null,
 *   deploymentURL?: string|null,
 *   description?: string|null,
 *   edges?: list<mixed>|null,
 *   name?: string|null,
 *   nodes?: list<mixed>|null,
 *   triggerConfig?: mixed,
 *   triggerType?: string|null,
 *   updatedAt?: string|null,
 *   visibility?: string|null,
 * }
 */
final class V1GetResponse implements BaseModel
{
    /** @use SdkModel<V1GetResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?string $createdAt;

    #[Optional]
    public ?string $deployedAt;

    #[Optional('deploymentUrl')]
    public ?string $deploymentURL;

    #[Optional]
    public ?string $description;

    /** @var list<mixed>|null $edges */
    #[Optional(list: 'mixed')]
    public ?array $edges;

    #[Optional]
    public ?string $name;

    /** @var list<mixed>|null $nodes */
    #[Optional(list: 'mixed')]
    public ?array $nodes;

    #[Optional]
    public mixed $triggerConfig;

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
     *
     * @param list<mixed>|null $edges
     * @param list<mixed>|null $nodes
     */
    public static function with(
        ?string $id = null,
        ?string $createdAt = null,
        ?string $deployedAt = null,
        ?string $deploymentURL = null,
        ?string $description = null,
        ?array $edges = null,
        ?string $name = null,
        ?array $nodes = null,
        mixed $triggerConfig = null,
        ?string $triggerType = null,
        ?string $updatedAt = null,
        ?string $visibility = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $deployedAt && $self['deployedAt'] = $deployedAt;
        null !== $deploymentURL && $self['deploymentURL'] = $deploymentURL;
        null !== $description && $self['description'] = $description;
        null !== $edges && $self['edges'] = $edges;
        null !== $name && $self['name'] = $name;
        null !== $nodes && $self['nodes'] = $nodes;
        null !== $triggerConfig && $self['triggerConfig'] = $triggerConfig;
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

    public function withDeploymentURL(string $deploymentURL): self
    {
        $self = clone $this;
        $self['deploymentURL'] = $deploymentURL;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * @param list<mixed> $edges
     */
    public function withEdges(array $edges): self
    {
        $self = clone $this;
        $self['edges'] = $edges;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param list<mixed> $nodes
     */
    public function withNodes(array $nodes): self
    {
        $self = clone $this;
        $self['nodes'] = $nodes;

        return $self;
    }

    public function withTriggerConfig(mixed $triggerConfig): self
    {
        $self = clone $this;
        $self['triggerConfig'] = $triggerConfig;

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
