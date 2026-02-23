<?php

declare(strict_types=1);

namespace Router\Compute\V1\Instances;

use Router\Compute\V1\Instances\InstanceListResponse\Instance;
use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type InstanceShape from \Router\Compute\V1\Instances\InstanceListResponse\Instance
 *
 * @phpstan-type InstanceListResponseShape = array{
 *   count?: int|null, instances?: list<Instance|InstanceShape>|null
 * }
 */
final class InstanceListResponse implements BaseModel
{
    /** @use SdkModel<InstanceListResponseShape> */
    use SdkModel;

    #[Optional]
    public ?int $count;

    /** @var list<Instance>|null $instances */
    #[Optional(list: Instance::class)]
    public ?array $instances;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Instance|InstanceShape>|null $instances
     */
    public static function with(
        ?int $count = null,
        ?array $instances = null
    ): self {
        $self = new self;

        null !== $count && $self['count'] = $count;
        null !== $instances && $self['instances'] = $instances;

        return $self;
    }

    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    /**
     * @param list<Instance|InstanceShape> $instances
     */
    public function withInstances(array $instances): self
    {
        $self = clone $this;
        $self['instances'] = $instances;

        return $self;
    }
}
