<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type V1GetResponseShape = array{
 *   id?: string|null,
 *   createdAt?: string|null,
 *   deployedAt?: string|null,
 *   deploymentUrl?: string|null,
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

    #[Api(optional: true)]
    public ?string $id;

    #[Api(optional: true)]
    public ?string $createdAt;

    #[Api(optional: true)]
    public ?string $deployedAt;

    #[Api(optional: true)]
    public ?string $deploymentUrl;

    #[Api(optional: true)]
    public ?string $description;

    /** @var list<mixed>|null $edges */
    #[Api(list: 'mixed', optional: true)]
    public ?array $edges;

    #[Api(optional: true)]
    public ?string $name;

    /** @var list<mixed>|null $nodes */
    #[Api(list: 'mixed', optional: true)]
    public ?array $nodes;

    #[Api(optional: true)]
    public mixed $triggerConfig;

    #[Api(optional: true)]
    public ?string $triggerType;

    #[Api(optional: true)]
    public ?string $updatedAt;

    #[Api(optional: true)]
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
     * @param list<mixed> $edges
     * @param list<mixed> $nodes
     */
    public static function with(
        ?string $id = null,
        ?string $createdAt = null,
        ?string $deployedAt = null,
        ?string $deploymentUrl = null,
        ?string $description = null,
        ?array $edges = null,
        ?string $name = null,
        ?array $nodes = null,
        mixed $triggerConfig = null,
        ?string $triggerType = null,
        ?string $updatedAt = null,
        ?string $visibility = null,
    ): self {
        $obj = new self;

        null !== $id && $obj['id'] = $id;
        null !== $createdAt && $obj['createdAt'] = $createdAt;
        null !== $deployedAt && $obj['deployedAt'] = $deployedAt;
        null !== $deploymentUrl && $obj['deploymentUrl'] = $deploymentUrl;
        null !== $description && $obj['description'] = $description;
        null !== $edges && $obj['edges'] = $edges;
        null !== $name && $obj['name'] = $name;
        null !== $nodes && $obj['nodes'] = $nodes;
        null !== $triggerConfig && $obj['triggerConfig'] = $triggerConfig;
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

    public function withDeploymentURL(string $deploymentURL): self
    {
        $obj = clone $this;
        $obj['deploymentUrl'] = $deploymentURL;

        return $obj;
    }

    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * @param list<mixed> $edges
     */
    public function withEdges(array $edges): self
    {
        $obj = clone $this;
        $obj['edges'] = $edges;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * @param list<mixed> $nodes
     */
    public function withNodes(array $nodes): self
    {
        $obj = clone $this;
        $obj['nodes'] = $nodes;

        return $obj;
    }

    public function withTriggerConfig(mixed $triggerConfig): self
    {
        $obj = clone $this;
        $obj['triggerConfig'] = $triggerConfig;

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
