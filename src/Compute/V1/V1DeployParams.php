<?php

declare(strict_types=1);

namespace Casedev\Compute\V1;

use Casedev\Compute\V1\V1DeployParams\Config;
use Casedev\Compute\V1\V1DeployParams\Runtime;
use Casedev\Compute\V1\V1DeployParams\Type;
use Casedev\Core\Attributes\Api;
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
 *   config?: Config,
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
    #[Api]
    public string $entrypointName;

    /**
     * Deployment type: task for batch jobs, service for web endpoints.
     *
     * @var value-of<Type> $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Python code (required for python runtime).
     */
    #[Api(optional: true)]
    public ?string $code;

    /**
     * Runtime and resource configuration.
     */
    #[Api(optional: true)]
    public ?Config $config;

    /**
     * Dockerfile content (required for dockerfile runtime).
     */
    #[Api(optional: true)]
    public ?string $dockerfile;

    /**
     * Python entrypoint file name.
     */
    #[Api(optional: true)]
    public ?string $entrypointFile;

    /**
     * Environment name (uses default if not specified).
     */
    #[Api(optional: true)]
    public ?string $environment;

    /**
     * Container image name (required for image runtime, e.g., 'nvidia/cuda:12.8.1-devel-ubuntu22.04').
     */
    #[Api(optional: true)]
    public ?string $image;

    /**
     * Runtime environment.
     *
     * @var value-of<Runtime>|null $runtime
     */
    #[Api(enum: Runtime::class, optional: true)]
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
     * @param Runtime|value-of<Runtime> $runtime
     */
    public static function with(
        string $entrypointName,
        Type|string $type,
        ?string $code = null,
        ?Config $config = null,
        ?string $dockerfile = null,
        ?string $entrypointFile = null,
        ?string $environment = null,
        ?string $image = null,
        Runtime|string|null $runtime = null,
    ): self {
        $obj = new self;

        $obj->entrypointName = $entrypointName;
        $obj['type'] = $type;

        null !== $code && $obj->code = $code;
        null !== $config && $obj->config = $config;
        null !== $dockerfile && $obj->dockerfile = $dockerfile;
        null !== $entrypointFile && $obj->entrypointFile = $entrypointFile;
        null !== $environment && $obj->environment = $environment;
        null !== $image && $obj->image = $image;
        null !== $runtime && $obj['runtime'] = $runtime;

        return $obj;
    }

    /**
     * Function/app name (used for domain: hello → hello.org.case.systems).
     */
    public function withEntrypointName(string $entrypointName): self
    {
        $obj = clone $this;
        $obj->entrypointName = $entrypointName;

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
        $obj->code = $code;

        return $obj;
    }

    /**
     * Runtime and resource configuration.
     */
    public function withConfig(Config $config): self
    {
        $obj = clone $this;
        $obj->config = $config;

        return $obj;
    }

    /**
     * Dockerfile content (required for dockerfile runtime).
     */
    public function withDockerfile(string $dockerfile): self
    {
        $obj = clone $this;
        $obj->dockerfile = $dockerfile;

        return $obj;
    }

    /**
     * Python entrypoint file name.
     */
    public function withEntrypointFile(string $entrypointFile): self
    {
        $obj = clone $this;
        $obj->entrypointFile = $entrypointFile;

        return $obj;
    }

    /**
     * Environment name (uses default if not specified).
     */
    public function withEnvironment(string $environment): self
    {
        $obj = clone $this;
        $obj->environment = $environment;

        return $obj;
    }

    /**
     * Container image name (required for image runtime, e.g., 'nvidia/cuda:12.8.1-devel-ubuntu22.04').
     */
    public function withImage(string $image): self
    {
        $obj = clone $this;
        $obj->image = $image;

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
