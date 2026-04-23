<?php

declare(strict_types=1);

namespace CaseDev\Compute\V1\InstanceTypes\InstanceTypeListResponse\InstanceType;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SpecsShape = array{
 *   memoryGib?: int|null, storageGib?: int|null, vcpus?: int|null
 * }
 */
final class Specs implements BaseModel
{
    /** @use SdkModel<SpecsShape> */
    use SdkModel;

    /**
     * RAM in GiB.
     */
    #[Optional]
    public ?int $memoryGib;

    /**
     * Storage in GiB.
     */
    #[Optional]
    public ?int $storageGib;

    /**
     * Number of vCPUs.
     */
    #[Optional]
    public ?int $vcpus;

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
        ?int $memoryGib = null,
        ?int $storageGib = null,
        ?int $vcpus = null
    ): self {
        $self = new self;

        null !== $memoryGib && $self['memoryGib'] = $memoryGib;
        null !== $storageGib && $self['storageGib'] = $storageGib;
        null !== $vcpus && $self['vcpus'] = $vcpus;

        return $self;
    }

    /**
     * RAM in GiB.
     */
    public function withMemoryGib(int $memoryGib): self
    {
        $self = clone $this;
        $self['memoryGib'] = $memoryGib;

        return $self;
    }

    /**
     * Storage in GiB.
     */
    public function withStorageGib(int $storageGib): self
    {
        $self = clone $this;
        $self['storageGib'] = $storageGib;

        return $self;
    }

    /**
     * Number of vCPUs.
     */
    public function withVcpus(int $vcpus): self
    {
        $self = clone $this;
        $self['vcpus'] = $vcpus;

        return $self;
    }
}
