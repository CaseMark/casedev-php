<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Workflows\V1\V1CreateParams\TriggerType;
use Casedev\Workflows\V1\V1CreateParams\Visibility;

/**
 * Create a new visual workflow with nodes, edges, and trigger configuration.
 *
 * @see Casedev\Services\Workflows\V1Service::create()
 *
 * @phpstan-type V1CreateParamsShape = array{
 *   name: string,
 *   description?: string,
 *   edges?: list<mixed>,
 *   nodes?: list<mixed>,
 *   triggerConfig?: mixed,
 *   triggerType?: TriggerType|value-of<TriggerType>,
 *   visibility?: Visibility|value-of<Visibility>,
 * }
 */
final class V1CreateParams implements BaseModel
{
    /** @use SdkModel<V1CreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Workflow name.
     */
    #[Api]
    public string $name;

    /**
     * Workflow description.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * React Flow edges.
     *
     * @var list<mixed>|null $edges
     */
    #[Api(list: 'mixed', optional: true)]
    public ?array $edges;

    /**
     * React Flow nodes.
     *
     * @var list<mixed>|null $nodes
     */
    #[Api(list: 'mixed', optional: true)]
    public ?array $nodes;

    /**
     * Trigger configuration.
     */
    #[Api(optional: true)]
    public mixed $triggerConfig;

    /** @var value-of<TriggerType>|null $triggerType */
    #[Api(enum: TriggerType::class, optional: true)]
    public ?string $triggerType;

    /**
     * Workflow visibility.
     *
     * @var value-of<Visibility>|null $visibility
     */
    #[Api(enum: Visibility::class, optional: true)]
    public ?string $visibility;

    /**
     * `new V1CreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1CreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1CreateParams)->withName(...)
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
     * @param list<mixed> $edges
     * @param list<mixed> $nodes
     * @param TriggerType|value-of<TriggerType> $triggerType
     * @param Visibility|value-of<Visibility> $visibility
     */
    public static function with(
        string $name,
        ?string $description = null,
        ?array $edges = null,
        ?array $nodes = null,
        mixed $triggerConfig = null,
        TriggerType|string|null $triggerType = null,
        Visibility|string|null $visibility = null,
    ): self {
        $obj = new self;

        $obj->name = $name;

        null !== $description && $obj->description = $description;
        null !== $edges && $obj->edges = $edges;
        null !== $nodes && $obj->nodes = $nodes;
        null !== $triggerConfig && $obj->triggerConfig = $triggerConfig;
        null !== $triggerType && $obj['triggerType'] = $triggerType;
        null !== $visibility && $obj['visibility'] = $visibility;

        return $obj;
    }

    /**
     * Workflow name.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Workflow description.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * React Flow edges.
     *
     * @param list<mixed> $edges
     */
    public function withEdges(array $edges): self
    {
        $obj = clone $this;
        $obj->edges = $edges;

        return $obj;
    }

    /**
     * React Flow nodes.
     *
     * @param list<mixed> $nodes
     */
    public function withNodes(array $nodes): self
    {
        $obj = clone $this;
        $obj->nodes = $nodes;

        return $obj;
    }

    /**
     * Trigger configuration.
     */
    public function withTriggerConfig(mixed $triggerConfig): self
    {
        $obj = clone $this;
        $obj->triggerConfig = $triggerConfig;

        return $obj;
    }

    /**
     * @param TriggerType|value-of<TriggerType> $triggerType
     */
    public function withTriggerType(TriggerType|string $triggerType): self
    {
        $obj = clone $this;
        $obj['triggerType'] = $triggerType;

        return $obj;
    }

    /**
     * Workflow visibility.
     *
     * @param Visibility|value-of<Visibility> $visibility
     */
    public function withVisibility(Visibility|string $visibility): self
    {
        $obj = clone $this;
        $obj['visibility'] = $visibility;

        return $obj;
    }
}
