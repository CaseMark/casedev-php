<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\V1DeployParams;

use Casedev\Compute\V1\V1DeployParams\Config\GPUType;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * Runtime and resource configuration.
 *
 * @phpstan-type ConfigShape = array{
 *   addPython?: string|null,
 *   allowNetwork?: bool|null,
 *   cmd?: list<string>|null,
 *   concurrency?: int|null,
 *   cpuCount?: int|null,
 *   cronSchedule?: string|null,
 *   dependencies?: list<string>|null,
 *   entrypoint?: list<string>|null,
 *   env?: array<string,string>|null,
 *   gpuCount?: int|null,
 *   gpuType?: value-of<GPUType>|null,
 *   isWebService?: bool|null,
 *   memoryMB?: int|null,
 *   pipInstall?: list<string>|null,
 *   port?: int|null,
 *   pythonVersion?: string|null,
 *   retries?: int|null,
 *   secretGroups?: list<string>|null,
 *   timeoutSeconds?: int|null,
 *   useUv?: bool|null,
 *   warmInstances?: int|null,
 *   workdir?: string|null,
 * }
 */
final class Config implements BaseModel
{
    /** @use SdkModel<ConfigShape> */
    use SdkModel;

    /**
     * Add Python to image (e.g., '3.12', for image runtime).
     */
    #[Optional]
    public ?string $addPython;

    /**
     * Allow network access (default: false for Python, true for Docker).
     */
    #[Optional]
    public ?bool $allowNetwork;

    /**
     * Container command arguments.
     *
     * @var list<string>|null $cmd
     */
    #[Optional(list: 'string')]
    public ?array $cmd;

    /**
     * Concurrent execution limit.
     */
    #[Optional]
    public ?int $concurrency;

    /**
     * CPU core count.
     */
    #[Optional]
    public ?int $cpuCount;

    /**
     * Cron schedule for periodic execution.
     */
    #[Optional]
    public ?string $cronSchedule;

    /**
     * Python package dependencies (python runtime).
     *
     * @var list<string>|null $dependencies
     */
    #[Optional(list: 'string')]
    public ?array $dependencies;

    /**
     * Container entrypoint command.
     *
     * @var list<string>|null $entrypoint
     */
    #[Optional(list: 'string')]
    public ?array $entrypoint;

    /**
     * Environment variables.
     *
     * @var array<string,string>|null $env
     */
    #[Optional(map: 'string')]
    public ?array $env;

    /**
     * Number of GPUs (for multi-GPU setups).
     */
    #[Optional]
    public ?int $gpuCount;

    /**
     * GPU type for acceleration.
     *
     * @var value-of<GPUType>|null $gpuType
     */
    #[Optional(enum: GPUType::class)]
    public ?string $gpuType;

    /**
     * Deploy as web service (auto-set for service type).
     */
    #[Optional]
    public ?bool $isWebService;

    /**
     * Memory allocation in MB.
     */
    #[Optional('memoryMb')]
    public ?int $memoryMB;

    /**
     * Packages to pip install (image runtime).
     *
     * @var list<string>|null $pipInstall
     */
    #[Optional(list: 'string')]
    public ?array $pipInstall;

    /**
     * Port for web services.
     */
    #[Optional]
    public ?int $port;

    /**
     * Python version (e.g., '3.11').
     */
    #[Optional]
    public ?string $pythonVersion;

    /**
     * Retry attempts on failure (Python only).
     */
    #[Optional]
    public ?int $retries;

    /**
     * Secret group names to inject.
     *
     * @var list<string>|null $secretGroups
     */
    #[Optional(list: 'string')]
    public ?array $secretGroups;

    /**
     * Maximum execution time.
     */
    #[Optional]
    public ?int $timeoutSeconds;

    /**
     * Use uv for faster package installs.
     */
    #[Optional]
    public ?bool $useUv;

    /**
     * Number of warm instances to maintain.
     */
    #[Optional]
    public ?int $warmInstances;

    /**
     * Working directory in container.
     */
    #[Optional]
    public ?string $workdir;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string> $cmd
     * @param list<string> $dependencies
     * @param list<string> $entrypoint
     * @param array<string,string> $env
     * @param GPUType|value-of<GPUType> $gpuType
     * @param list<string> $pipInstall
     * @param list<string> $secretGroups
     */
    public static function with(
        ?string $addPython = null,
        ?bool $allowNetwork = null,
        ?array $cmd = null,
        ?int $concurrency = null,
        ?int $cpuCount = null,
        ?string $cronSchedule = null,
        ?array $dependencies = null,
        ?array $entrypoint = null,
        ?array $env = null,
        ?int $gpuCount = null,
        GPUType|string|null $gpuType = null,
        ?bool $isWebService = null,
        ?int $memoryMB = null,
        ?array $pipInstall = null,
        ?int $port = null,
        ?string $pythonVersion = null,
        ?int $retries = null,
        ?array $secretGroups = null,
        ?int $timeoutSeconds = null,
        ?bool $useUv = null,
        ?int $warmInstances = null,
        ?string $workdir = null,
    ): self {
        $self = new self;

        null !== $addPython && $self['addPython'] = $addPython;
        null !== $allowNetwork && $self['allowNetwork'] = $allowNetwork;
        null !== $cmd && $self['cmd'] = $cmd;
        null !== $concurrency && $self['concurrency'] = $concurrency;
        null !== $cpuCount && $self['cpuCount'] = $cpuCount;
        null !== $cronSchedule && $self['cronSchedule'] = $cronSchedule;
        null !== $dependencies && $self['dependencies'] = $dependencies;
        null !== $entrypoint && $self['entrypoint'] = $entrypoint;
        null !== $env && $self['env'] = $env;
        null !== $gpuCount && $self['gpuCount'] = $gpuCount;
        null !== $gpuType && $self['gpuType'] = $gpuType;
        null !== $isWebService && $self['isWebService'] = $isWebService;
        null !== $memoryMB && $self['memoryMB'] = $memoryMB;
        null !== $pipInstall && $self['pipInstall'] = $pipInstall;
        null !== $port && $self['port'] = $port;
        null !== $pythonVersion && $self['pythonVersion'] = $pythonVersion;
        null !== $retries && $self['retries'] = $retries;
        null !== $secretGroups && $self['secretGroups'] = $secretGroups;
        null !== $timeoutSeconds && $self['timeoutSeconds'] = $timeoutSeconds;
        null !== $useUv && $self['useUv'] = $useUv;
        null !== $warmInstances && $self['warmInstances'] = $warmInstances;
        null !== $workdir && $self['workdir'] = $workdir;

        return $self;
    }

    /**
     * Add Python to image (e.g., '3.12', for image runtime).
     */
    public function withAddPython(string $addPython): self
    {
        $self = clone $this;
        $self['addPython'] = $addPython;

        return $self;
    }

    /**
     * Allow network access (default: false for Python, true for Docker).
     */
    public function withAllowNetwork(bool $allowNetwork): self
    {
        $self = clone $this;
        $self['allowNetwork'] = $allowNetwork;

        return $self;
    }

    /**
     * Container command arguments.
     *
     * @param list<string> $cmd
     */
    public function withCmd(array $cmd): self
    {
        $self = clone $this;
        $self['cmd'] = $cmd;

        return $self;
    }

    /**
     * Concurrent execution limit.
     */
    public function withConcurrency(int $concurrency): self
    {
        $self = clone $this;
        $self['concurrency'] = $concurrency;

        return $self;
    }

    /**
     * CPU core count.
     */
    public function withCPUCount(int $cpuCount): self
    {
        $self = clone $this;
        $self['cpuCount'] = $cpuCount;

        return $self;
    }

    /**
     * Cron schedule for periodic execution.
     */
    public function withCronSchedule(string $cronSchedule): self
    {
        $self = clone $this;
        $self['cronSchedule'] = $cronSchedule;

        return $self;
    }

    /**
     * Python package dependencies (python runtime).
     *
     * @param list<string> $dependencies
     */
    public function withDependencies(array $dependencies): self
    {
        $self = clone $this;
        $self['dependencies'] = $dependencies;

        return $self;
    }

    /**
     * Container entrypoint command.
     *
     * @param list<string> $entrypoint
     */
    public function withEntrypoint(array $entrypoint): self
    {
        $self = clone $this;
        $self['entrypoint'] = $entrypoint;

        return $self;
    }

    /**
     * Environment variables.
     *
     * @param array<string,string> $env
     */
    public function withEnv(array $env): self
    {
        $self = clone $this;
        $self['env'] = $env;

        return $self;
    }

    /**
     * Number of GPUs (for multi-GPU setups).
     */
    public function withGPUCount(int $gpuCount): self
    {
        $self = clone $this;
        $self['gpuCount'] = $gpuCount;

        return $self;
    }

    /**
     * GPU type for acceleration.
     *
     * @param GPUType|value-of<GPUType> $gpuType
     */
    public function withGPUType(GPUType|string $gpuType): self
    {
        $self = clone $this;
        $self['gpuType'] = $gpuType;

        return $self;
    }

    /**
     * Deploy as web service (auto-set for service type).
     */
    public function withIsWebService(bool $isWebService): self
    {
        $self = clone $this;
        $self['isWebService'] = $isWebService;

        return $self;
    }

    /**
     * Memory allocation in MB.
     */
    public function withMemoryMB(int $memoryMB): self
    {
        $self = clone $this;
        $self['memoryMB'] = $memoryMB;

        return $self;
    }

    /**
     * Packages to pip install (image runtime).
     *
     * @param list<string> $pipInstall
     */
    public function withPipInstall(array $pipInstall): self
    {
        $self = clone $this;
        $self['pipInstall'] = $pipInstall;

        return $self;
    }

    /**
     * Port for web services.
     */
    public function withPort(int $port): self
    {
        $self = clone $this;
        $self['port'] = $port;

        return $self;
    }

    /**
     * Python version (e.g., '3.11').
     */
    public function withPythonVersion(string $pythonVersion): self
    {
        $self = clone $this;
        $self['pythonVersion'] = $pythonVersion;

        return $self;
    }

    /**
     * Retry attempts on failure (Python only).
     */
    public function withRetries(int $retries): self
    {
        $self = clone $this;
        $self['retries'] = $retries;

        return $self;
    }

    /**
     * Secret group names to inject.
     *
     * @param list<string> $secretGroups
     */
    public function withSecretGroups(array $secretGroups): self
    {
        $self = clone $this;
        $self['secretGroups'] = $secretGroups;

        return $self;
    }

    /**
     * Maximum execution time.
     */
    public function withTimeoutSeconds(int $timeoutSeconds): self
    {
        $self = clone $this;
        $self['timeoutSeconds'] = $timeoutSeconds;

        return $self;
    }

    /**
     * Use uv for faster package installs.
     */
    public function withUseUv(bool $useUv): self
    {
        $self = clone $this;
        $self['useUv'] = $useUv;

        return $self;
    }

    /**
     * Number of warm instances to maintain.
     */
    public function withWarmInstances(int $warmInstances): self
    {
        $self = clone $this;
        $self['warmInstances'] = $warmInstances;

        return $self;
    }

    /**
     * Working directory in container.
     */
    public function withWorkdir(string $workdir): self
    {
        $self = clone $this;
        $self['workdir'] = $workdir;

        return $self;
    }
}
