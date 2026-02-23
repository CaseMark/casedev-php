<?php

declare(strict_types=1);

namespace Router\Compute\V1\InstanceTypes;

use Router\Compute\V1\InstanceTypes\InstanceTypeListResponse\InstanceType;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type InstanceTypeShape from \Router\Compute\V1\InstanceTypes\InstanceTypeListResponse\InstanceType
 *
 * @phpstan-type InstanceTypeListResponseShape = array{
 *   count: int, instanceTypes: list<InstanceType|InstanceTypeShape>
 * }
 */
final class InstanceTypeListResponse implements BaseModel
{
    /** @use SdkModel<InstanceTypeListResponseShape> */
    use SdkModel;

    /**
     * Total number of instance types.
     */
    #[Required]
    public int $count;

    /** @var list<InstanceType> $instanceTypes */
    #[Required(list: InstanceType::class)]
    public array $instanceTypes;

    /**
     * `new InstanceTypeListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InstanceTypeListResponse::with(count: ..., instanceTypes: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InstanceTypeListResponse)->withCount(...)->withInstanceTypes(...)
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
     * @param list<InstanceType|InstanceTypeShape> $instanceTypes
     */
    public static function with(int $count, array $instanceTypes): self
    {
        $self = new self;

        $self['count'] = $count;
        $self['instanceTypes'] = $instanceTypes;

        return $self;
    }

    /**
     * Total number of instance types.
     */
    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    /**
     * @param list<InstanceType|InstanceTypeShape> $instanceTypes
     */
    public function withInstanceTypes(array $instanceTypes): self
    {
        $self = clone $this;
        $self['instanceTypes'] = $instanceTypes;

        return $self;
    }
}
