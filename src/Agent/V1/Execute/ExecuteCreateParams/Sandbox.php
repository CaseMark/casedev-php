<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Execute\ExecuteCreateParams;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Custom sandbox resources (cpu, memoryMiB).
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
