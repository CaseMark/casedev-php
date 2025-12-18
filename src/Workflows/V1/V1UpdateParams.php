<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Optional;
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
 *   description?: string|null,
 *   edges?: list<mixed>|null,
 *   name?: string|null,
 *   nodes?: list<mixed>|null,
 *   triggerConfig?: mixed,
 *   triggerType?: null|TriggerType|value-of<TriggerType>,
 *   visibility?: null|Visibility|value-of<Visibility>,
 * }
 */
final class V1UpdateParams implements BaseModel
{
    /** @use SdkModel<V1UpdateParamsShape> */
    use SdkModel;
    use SdkParams;

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

    /** @var value-of<TriggerType>|null $triggerType */
    #[Optional(enum: TriggerType::class)]
    public ?string $triggerType;

    /** @var value-of<Visibility>|null $visibility */
    #[Optional(enum: Visibility::class)]
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
     * @param TriggerType|value-of<TriggerType>|null $triggerType
     * @param Visibility|value-of<Visibility>|null $visibility
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
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $edges && $self['edges'] = $edges;
        null !== $name && $self['name'] = $name;
        null !== $nodes && $self['nodes'] = $nodes;
        null !== $triggerConfig && $self['triggerConfig'] = $triggerConfig;
        null !== $triggerType && $self['triggerType'] = $triggerType;
        null !== $visibility && $self['visibility'] = $visibility;

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
     * @param Visibility|value-of<Visibility> $visibility
     */
    public function withVisibility(Visibility|string $visibility): self
    {
        $self = clone $this;
        $self['visibility'] = $visibility;

        return $self;
    }
}
