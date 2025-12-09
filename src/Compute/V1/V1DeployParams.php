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
 *     memoryMb?: int|null,
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
        $obj = new self;

        $obj['entrypointName'] = $entrypointName;
        $obj['type'] = $type;

        null !== $code && $obj['code'] = $code;
        null !== $config && $obj['config'] = $config;
        null !== $dockerfile && $obj['dockerfile'] = $dockerfile;
        null !== $entrypointFile && $obj['entrypointFile'] = $entrypointFile;
        null !== $environment && $obj['environment'] = $environment;
        null !== $image && $obj['image'] = $image;
        null !== $runtime && $obj['runtime'] = $runtime;

        return $obj;
    }

    /**
     * Function/app name (used for domain: hello → hello.org.case.systems).
     */
    public function withEntrypointName(string $entrypointName): self
    {
        $obj = clone $this;
        $obj['entrypointName'] = $entrypointName;

        return $obj;
    }

    /**
     * Deployment type: task for batch jobs, service for web endpoints.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * Python code (required for python runtime).
     */
    public function withCode(string $code): self
    {
        $obj = clone $this;
        $obj['code'] = $code;

        return $obj;
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
     * } $config
     */
    public function withConfig(Config|array $config): self
    {
        $obj = clone $this;
        $obj['config'] = $config;

        return $obj;
    }

    /**
     * Dockerfile content (required for dockerfile runtime).
     */
    public function withDockerfile(string $dockerfile): self
    {
        $obj = clone $this;
        $obj['dockerfile'] = $dockerfile;

        return $obj;
    }

    /**
     * Python entrypoint file name.
     */
    public function withEntrypointFile(string $entrypointFile): self
    {
        $obj = clone $this;
        $obj['entrypointFile'] = $entrypointFile;

        return $obj;
    }

    /**
     * Environment name (uses default if not specified).
     */
    public function withEnvironment(string $environment): self
    {
        $obj = clone $this;
        $obj['environment'] = $environment;

        return $obj;
    }

    /**
     * Container image name (required for image runtime, e.g., 'nvidia/cuda:12.8.1-devel-ubuntu22.04').
     */
    public function withImage(string $image): self
    {
        $obj = clone $this;
        $obj['image'] = $image;

        return $obj;
    }

    /**
     * Runtime environment.
     *
     * @param Runtime|value-of<Runtime> $runtime
     */
    public function withRuntime(Runtime|string $runtime): self
    {
        $obj = clone $this;
        $obj['runtime'] = $runtime;

        return $obj;
    }
}
