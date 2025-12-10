<?php

declare(strict_types=1);

namespace Casedev\Compute\V1;

use Casedev\Compute\V1\V1DeployParams\Config;
use Casedev\Compute\V1\V1DeployParams\Config\GPUType;
use Casedev\Compute\V1\V1DeployParams\Runtime;
use Casedev\Compute\V1\V1DeployParams\Type;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Deploy code to Case.dev's serverless compute infrastructure powered by Modal. Supports Python, Dockerfile, and container image runtimes with GPU acceleration for AI/ML workloads. Code is deployed as tasks (batch jobs) or services (web endpoints) with automatic scaling.
 *
 * @see Casedev\Services\Compute\V1Service::deploy()
 *
 * @phpstan-type V1DeployParamsShape = array{
 *   entrypointName: string,
 *   type: Type|value-of<Type>,
 *   code?: string,
 *   config?: Config|array{
 *     addPython?: string|null,
 *     allowNetwork?: bool|null,
 *     cmd?: list<string>|null,
 *     concurrency?: int|null,
 *     cpuCount?: int|null,
 *     cronSchedule?: string|null,
 *     dependencies?: list<string>|null,
 *     entrypoint?: list<string>|null,
 *     env?: array<string,string>|null,
 *     gpuCount?: int|null,
 *     gpuType?: value-of<GPUType>|null,
 *     isWebService?: bool|null,
 *     memoryMB?: int|null,
 *     pipInstall?: list<string>|null,
 *     port?: int|null,
 *     pythonVersion?: string|null,
 *     retries?: int|null,
 *     secretGroups?: list<string>|null,
 *     timeoutSeconds?: int|null,
 *     useUv?: bool|null,
 *     warmInstances?: int|null,
 *     workdir?: string|null,
 *   },
 *   dockerfile?: string,
 *   entrypointFile?: string,
 *   environment?: string,
 *   image?: string,
 *   runtime?: Runtime|value-of<Runtime>,
 * }
 */
final class V1DeployParams implements BaseModel
{
    /** @use SdkModel<V1DeployParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Function/app name (used for domain: hello → hello.org.case.systems).
     */
    #[Required]
    public string $entrypointName;

    /**
     * Deployment type: task for batch jobs, service for web endpoints.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Python code (required for python runtime).
     */
    #[Optional]
    public ?string $code;

    /**
     * Runtime and resource configuration.
     */
    #[Optional]
    public ?Config $config;

    /**
     * Dockerfile content (required for dockerfile runtime).
     */
    #[Optional]
    public ?string $dockerfile;

    /**
     * Python entrypoint file name.
     */
    #[Optional]
    public ?string $entrypointFile;

    /**
     * Environment name (uses default if not specified).
     */
    #[Optional]
    public ?string $environment;

    /**
     * Container image name (required for image runtime, e.g., 'nvidia/cuda:12.8.1-devel-ubuntu22.04').
     */
    #[Optional]
    public ?string $image;

    /**
     * Runtime environment.
     *
     * @var value-of<Runtime>|null $runtime
     */
    #[Optional(enum: Runtime::class)]
    public ?string $runtime;

    /**
     * `new V1DeployParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1DeployParams::with(entrypointName: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1DeployParams)->withEntrypointName(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     * @param Config|array{
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
     * } $config
     * @param Runtime|value-of<Runtime> $runtime
     */
    public static function with(
        string $entrypointName,
        Type|string $type,
        ?string $code = null,
        Config|array|null $config = null,
        ?string $dockerfile = null,
        ?string $entrypointFile = null,
        ?string $environment = null,
        ?string $image = null,
        Runtime|string|null $runtime = null,
    ): self {
        $self = new self;

        $self['entrypointName'] = $entrypointName;
        $self['type'] = $type;

        null !== $code && $self['code'] = $code;
        null !== $config && $self['config'] = $config;
        null !== $dockerfile && $self['dockerfile'] = $dockerfile;
        null !== $entrypointFile && $self['entrypointFile'] = $entrypointFile;
        null !== $environment && $self['environment'] = $environment;
        null !== $image && $self['image'] = $image;
        null !== $runtime && $self['runtime'] = $runtime;

        return $self;
    }

    /**
     * Function/app name (used for domain: hello → hello.org.case.systems).
     */
    public function withEntrypointName(string $entrypointName): self
    {
        $self = clone $this;
        $self['entrypointName'] = $entrypointName;

        return $self;
    }

    /**
     * Deployment type: task for batch jobs, service for web endpoints.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Python code (required for python runtime).
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Runtime and resource configuration.
     *
     * @param Config|array{
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
     * } $config
     */
    public function withConfig(Config|array $config): self
    {
        $self = clone $this;
        $self['config'] = $config;

        return $self;
    }

    /**
     * Dockerfile content (required for dockerfile runtime).
     */
    public function withDockerfile(string $dockerfile): self
    {
        $self = clone $this;
        $self['dockerfile'] = $dockerfile;

        return $self;
    }

    /**
     * Python entrypoint file name.
     */
    public function withEntrypointFile(string $entrypointFile): self
    {
        $self = clone $this;
        $self['entrypointFile'] = $entrypointFile;

        return $self;
    }

    /**
     * Environment name (uses default if not specified).
     */
    public function withEnvironment(string $environment): self
    {
        $self = clone $this;
        $self['environment'] = $environment;

        return $self;
    }

    /**
     * Container image name (required for image runtime, e.g., 'nvidia/cuda:12.8.1-devel-ubuntu22.04').
     */
    public function withImage(string $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }

    /**
     * Runtime environment.
     *
     * @param Runtime|value-of<Runtime> $runtime
     */
    public function withRuntime(Runtime|string $runtime): self
    {
        $self = clone $this;
        $self['runtime'] = $runtime;

        return $self;
    }
}
