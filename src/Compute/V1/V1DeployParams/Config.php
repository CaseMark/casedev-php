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
 *   memoryMb?: int|null,
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
    #[Optional]
    public ?int $memoryMb;

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
        ?int $memoryMb = null,
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
        $obj = new self;

        null !== $addPython && $obj['addPython'] = $addPython;
        null !== $allowNetwork && $obj['allowNetwork'] = $allowNetwork;
        null !== $cmd && $obj['cmd'] = $cmd;
        null !== $concurrency && $obj['concurrency'] = $concurrency;
        null !== $cpuCount && $obj['cpuCount'] = $cpuCount;
        null !== $cronSchedule && $obj['cronSchedule'] = $cronSchedule;
        null !== $dependencies && $obj['dependencies'] = $dependencies;
        null !== $entrypoint && $obj['entrypoint'] = $entrypoint;
        null !== $env && $obj['env'] = $env;
        null !== $gpuCount && $obj['gpuCount'] = $gpuCount;
        null !== $gpuType && $obj['gpuType'] = $gpuType;
        null !== $isWebService && $obj['isWebService'] = $isWebService;
        null !== $memoryMb && $obj['memoryMb'] = $memoryMb;
        null !== $pipInstall && $obj['pipInstall'] = $pipInstall;
        null !== $port && $obj['port'] = $port;
        null !== $pythonVersion && $obj['pythonVersion'] = $pythonVersion;
        null !== $retries && $obj['retries'] = $retries;
        null !== $secretGroups && $obj['secretGroups'] = $secretGroups;
        null !== $timeoutSeconds && $obj['timeoutSeconds'] = $timeoutSeconds;
        null !== $useUv && $obj['useUv'] = $useUv;
        null !== $warmInstances && $obj['warmInstances'] = $warmInstances;
        null !== $workdir && $obj['workdir'] = $workdir;

        return $obj;
    }

    /**
     * Add Python to image (e.g., '3.12', for image runtime).
     */
    public function withAddPython(string $addPython): self
    {
        $obj = clone $this;
        $obj['addPython'] = $addPython;

        return $obj;
    }

    /**
     * Allow network access (default: false for Python, true for Docker).
     */
    public function withAllowNetwork(bool $allowNetwork): self
    {
        $obj = clone $this;
        $obj['allowNetwork'] = $allowNetwork;

        return $obj;
    }

    /**
     * Container command arguments.
     *
     * @param list<string> $cmd
     */
    public function withCmd(array $cmd): self
    {
        $obj = clone $this;
        $obj['cmd'] = $cmd;

        return $obj;
    }

    /**
     * Concurrent execution limit.
     */
    public function withConcurrency(int $concurrency): self
    {
        $obj = clone $this;
        $obj['concurrency'] = $concurrency;

        return $obj;
    }

    /**
     * CPU core count.
     */
    public function withCPUCount(int $cpuCount): self
    {
        $obj = clone $this;
        $obj['cpuCount'] = $cpuCount;

        return $obj;
    }

    /**
     * Cron schedule for periodic execution.
     */
    public function withCronSchedule(string $cronSchedule): self
    {
        $obj = clone $this;
        $obj['cronSchedule'] = $cronSchedule;

        return $obj;
    }

    /**
     * Python package dependencies (python runtime).
     *
     * @param list<string> $dependencies
     */
    public function withDependencies(array $dependencies): self
    {
        $obj = clone $this;
        $obj['dependencies'] = $dependencies;

        return $obj;
    }

    /**
     * Container entrypoint command.
     *
     * @param list<string> $entrypoint
     */
    public function withEntrypoint(array $entrypoint): self
    {
        $obj = clone $this;
        $obj['entrypoint'] = $entrypoint;

        return $obj;
    }

    /**
     * Environment variables.
     *
     * @param array<string,string> $env
     */
    public function withEnv(array $env): self
    {
        $obj = clone $this;
        $obj['env'] = $env;

        return $obj;
    }

    /**
     * Number of GPUs (for multi-GPU setups).
     */
    public function withGPUCount(int $gpuCount): self
    {
        $obj = clone $this;
        $obj['gpuCount'] = $gpuCount;

        return $obj;
    }

    /**
     * GPU type for acceleration.
     *
     * @param GPUType|value-of<GPUType> $gpuType
     */
    public function withGPUType(GPUType|string $gpuType): self
    {
        $obj = clone $this;
        $obj['gpuType'] = $gpuType;

        return $obj;
    }

    /**
     * Deploy as web service (auto-set for service type).
     */
    public function withIsWebService(bool $isWebService): self
    {
        $obj = clone $this;
        $obj['isWebService'] = $isWebService;

        return $obj;
    }

    /**
     * Memory allocation in MB.
     */
    public function withMemoryMB(int $memoryMB): self
    {
        $obj = clone $this;
        $obj['memoryMb'] = $memoryMB;

        return $obj;
    }

    /**
     * Packages to pip install (image runtime).
     *
     * @param list<string> $pipInstall
     */
    public function withPipInstall(array $pipInstall): self
    {
        $obj = clone $this;
        $obj['pipInstall'] = $pipInstall;

        return $obj;
    }

    /**
     * Port for web services.
     */
    public function withPort(int $port): self
    {
        $obj = clone $this;
        $obj['port'] = $port;

        return $obj;
    }

    /**
     * Python version (e.g., '3.11').
     */
    public function withPythonVersion(string $pythonVersion): self
    {
        $obj = clone $this;
        $obj['pythonVersion'] = $pythonVersion;

        return $obj;
    }

    /**
     * Retry attempts on failure (Python only).
     */
    public function withRetries(int $retries): self
    {
        $obj = clone $this;
        $obj['retries'] = $retries;

        return $obj;
    }

    /**
     * Secret group names to inject.
     *
     * @param list<string> $secretGroups
     */
    public function withSecretGroups(array $secretGroups): self
    {
        $obj = clone $this;
        $obj['secretGroups'] = $secretGroups;

        return $obj;
    }

    /**
     * Maximum execution time.
     */
    public function withTimeoutSeconds(int $timeoutSeconds): self
    {
        $obj = clone $this;
        $obj['timeoutSeconds'] = $timeoutSeconds;

        return $obj;
    }

    /**
     * Use uv for faster package installs.
     */
    public function withUseUv(bool $useUv): self
    {
        $obj = clone $this;
        $obj['useUv'] = $useUv;

        return $obj;
    }

    /**
     * Number of warm instances to maintain.
     */
    public function withWarmInstances(int $warmInstances): self
    {
        $obj = clone $this;
        $obj['warmInstances'] = $warmInstances;

        return $obj;
    }

    /**
     * Working directory in container.
     */
    public function withWorkdir(string $workdir): self
    {
        $obj = clone $this;
        $obj['workdir'] = $workdir;

        return $obj;
    }
}
