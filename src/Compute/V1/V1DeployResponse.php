<?php

declare(strict_types=1);

namespace Casedev\Compute\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type V1DeployResponseShape = array{
 *   createdAt?: \DateTimeInterface|null,
 *   deploymentId?: string|null,
 *   environment?: string|null,
 *   runtime?: string|null,
 *   status?: string|null,
 *   url?: string|null,
 * }
 */
final class V1DeployResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<V1DeployResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Deployment timestamp.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $createdAt;

    /**
     * Unique deployment identifier.
     */
    #[Api(optional: true)]
    public ?string $deploymentId;

    /**
     * Environment name.
     */
    #[Api(optional: true)]
    public ?string $environment;

    /**
     * Runtime used.
     */
    #[Api(optional: true)]
    public ?string $runtime;

    /**
     * Deployment status.
     */
    #[Api(optional: true)]
    public ?string $status;

    /**
     * Service endpoint URL (for web services).
     */
    #[Api(optional: true)]
    public ?string $url;

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
        ?\DateTimeInterface $createdAt = null,
        ?string $deploymentId = null,
        ?string $environment = null,
        ?string $runtime = null,
        ?string $status = null,
        ?string $url = null,
    ): self {
        $obj = new self;

        null !== $createdAt && $obj->createdAt = $createdAt;
        null !== $deploymentId && $obj->deploymentId = $deploymentId;
        null !== $environment && $obj->environment = $environment;
        null !== $runtime && $obj->runtime = $runtime;
        null !== $status && $obj->status = $status;
        null !== $url && $obj->url = $url;

        return $obj;
    }

    /**
     * Deployment timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * Unique deployment identifier.
     */
    public function withDeploymentID(string $deploymentID): self
    {
        $obj = clone $this;
        $obj->deploymentId = $deploymentID;

        return $obj;
    }

    /**
     * Environment name.
     */
    public function withEnvironment(string $environment): self
    {
        $obj = clone $this;
        $obj->environment = $environment;

        return $obj;
    }

    /**
     * Runtime used.
     */
    public function withRuntime(string $runtime): self
    {
        $obj = clone $this;
        $obj->runtime = $runtime;

        return $obj;
    }

    /**
     * Deployment status.
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }

    /**
     * Service endpoint URL (for web services).
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
