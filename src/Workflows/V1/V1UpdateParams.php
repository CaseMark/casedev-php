<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Workflows\V1\V1UpdateParams\TriggerType;
use Casedev\Workflows\V1\V1UpdateParams\Visibility;

/**
 * Update an existing workflow's configuration.
 *
 * @see Casedev\Services\Workflows\V1Service::update()
 *
 * @phpstan-type V1UpdateParamsShape = array{
 *   description?: string,
 *   edges?: list<mixed>,
 *   name?: string,
 *   nodes?: list<mixed>,
 *   triggerConfig?: mixed,
 *   triggerType?: TriggerType|value-of<TriggerType>,
 *   visibility?: Visibility|value-of<Visibility>,
 * }
 */
final class V1UpdateParams implements BaseModel
{
    /** @use SdkModel<V1UpdateParamsShape> */
    use SdkModel;
    use SdkParams;

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

    /** @var value-of<TriggerType>|null $triggerType */
    #[Api(enum: TriggerType::class, optional: true)]
    public ?string $triggerType;

    /** @var value-of<Visibility>|null $visibility */
    #[Api(enum: Visibility::class, optional: true)]
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
     * @param TriggerType|value-of<TriggerType> $triggerType
     * @param Visibility|value-of<Visibility> $visibility
     */
    public static function with(
        ?string $description = null,
        ?array $edges = null,
        ?string $name = null,
        ?array $nodes = null,
        mixed $triggerConfig = null,
        TriggerType|string|null $triggerType = null,
        Visibility|string|null $visibility = null,
    ): self {
        $obj = new self;

        null !== $description && $obj->description = $description;
        null !== $edges && $obj->edges = $edges;
        null !== $name && $obj->name = $name;
        null !== $nodes && $obj->nodes = $nodes;
        null !== $triggerConfig && $obj->triggerConfig = $triggerConfig;
        null !== $triggerType && $obj['triggerType'] = $triggerType;
        null !== $visibility && $obj['visibility'] = $visibility;

        return $obj;
    }

    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * @param list<mixed> $edges
     */
    public function withEdges(array $edges): self
    {
        $obj = clone $this;
        $obj->edges = $edges;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * @param list<mixed> $nodes
     */
    public function withNodes(array $nodes): self
    {
        $obj = clone $this;
        $obj->nodes = $nodes;

        return $obj;
    }

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
     * @param Visibility|value-of<Visibility> $visibility
     */
    public function withVisibility(Visibility|string $visibility): self
    {
        $obj = clone $this;
        $obj['visibility'] = $visibility;

        return $obj;
    }
}
