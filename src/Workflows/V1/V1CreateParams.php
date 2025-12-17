<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
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
 *   description?: string|null,
 *   edges?: list<mixed>|null,
 *   nodes?: list<mixed>|null,
 *   triggerConfig?: mixed,
 *   triggerType?: null|TriggerType|value-of<TriggerType>,
 *   visibility?: null|Visibility|value-of<Visibility>,
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
    #[Required]
    public string $name;

    /**
     * Workflow description.
     */
    #[Optional]
    public ?string $description;

    /**
     * React Flow edges.
     *
     * @var list<mixed>|null $edges
     */
    #[Optional(list: 'mixed')]
    public ?array $edges;

    /**
     * React Flow nodes.
     *
     * @var list<mixed>|null $nodes
     */
    #[Optional(list: 'mixed')]
    public ?array $nodes;

    /**
     * Trigger configuration.
     */
    #[Optional]
    public mixed $triggerConfig;

    /** @var value-of<TriggerType>|null $triggerType */
    #[Optional(enum: TriggerType::class)]
    public ?string $triggerType;

    /**
     * Workflow visibility.
     *
     * @var value-of<Visibility>|null $visibility
     */
    #[Optional(enum: Visibility::class)]
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
        $self = new self;

        $self['name'] = $name;

        null !== $description && $self['description'] = $description;
        null !== $edges && $self['edges'] = $edges;
        null !== $nodes && $self['nodes'] = $nodes;
        null !== $triggerConfig && $self['triggerConfig'] = $triggerConfig;
        null !== $triggerType && $self['triggerType'] = $triggerType;
        null !== $visibility && $self['visibility'] = $visibility;

        return $self;
    }

    /**
     * Workflow name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Workflow description.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * React Flow edges.
     *
     * @param list<mixed> $edges
     */
    public function withEdges(array $edges): self
    {
        $self = clone $this;
        $self['edges'] = $edges;

        return $self;
    }

    /**
     * React Flow nodes.
     *
     * @param list<mixed> $nodes
     */
    public function withNodes(array $nodes): self
    {
        $self = clone $this;
        $self['nodes'] = $nodes;

        return $self;
    }

    /**
     * Trigger configuration.
     */
    public function withTriggerConfig(mixed $triggerConfig): self
    {
        $self = clone $this;
        $self['triggerConfig'] = $triggerConfig;

        return $self;
    }

    /**
     * @param TriggerType|value-of<TriggerType> $triggerType
     */
    public function withTriggerType(TriggerType|string $triggerType): self
    {
        $self = clone $this;
        $self['triggerType'] = $triggerType;

        return $self;
    }

    /**
     * Workflow visibility.
     *
     * @param Visibility|value-of<Visibility> $visibility
     */
    public function withVisibility(Visibility|string $visibility): self
    {
        $self = clone $this;
        $self['visibility'] = $visibility;

        return $self;
    }
}
