<?php

declare(strict_types=1);

namespace Router\Agent\V1\Agents\AgentCreateParams;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * Custom sandbox configuration (cpu, memoryMiB).
 *
 * @phpstan-type SandboxShape = array{cpu?: int|null, memoryMiB?: int|null}
 */
final class Sandbox implements BaseModel
{
    /** @use SdkModel<SandboxShape> */
    use SdkModel;

    /**
     * Number of CPUs.
     */
    #[Optional]
    public ?int $cpu;

    /**
     * Memory in MiB.
     */
    #[Optional]
    public ?int $memoryMiB;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $cpu = null, ?int $memoryMiB = null): self
    {
        $self = new self;

        null !== $cpu && $self['cpu'] = $cpu;
        null !== $memoryMiB && $self['memoryMiB'] = $memoryMiB;

        return $self;
    }

    /**
     * Number of CPUs.
     */
    public function withCPU(int $cpu): self
    {
        $self = clone $this;
        $self['cpu'] = $cpu;

        return $self;
    }

    /**
     * Memory in MiB.
     */
    public function withMemoryMiB(int $memoryMiB): self
    {
        $self = clone $this;
        $self['memoryMiB'] = $memoryMiB;

        return $self;
    }
}
