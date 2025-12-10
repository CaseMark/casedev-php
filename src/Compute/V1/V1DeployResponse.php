<?php

declare(strict_types=1);

namespace Casedev\Compute\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type V1DeployResponseShape = array{
 *   createdAt?: \DateTimeInterface|null,
 *   deploymentID?: string|null,
 *   environment?: string|null,
 *   runtime?: string|null,
 *   status?: string|null,
 *   url?: string|null,
 * }
 */
final class V1DeployResponse implements BaseModel
{
    /** @use SdkModel<V1DeployResponseShape> */
    use SdkModel;

    /**
     * Deployment timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * Unique deployment identifier.
     */
    #[Optional('deploymentId')]
    public ?string $deploymentID;

    /**
     * Environment name.
     */
    #[Optional]
    public ?string $environment;

    /**
     * Runtime used.
     */
    #[Optional]
    public ?string $runtime;

    /**
     * Deployment status.
     */
    #[Optional]
    public ?string $status;

    /**
     * Service endpoint URL (for web services).
     */
    #[Optional]
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
        ?string $deploymentID = null,
        ?string $environment = null,
        ?string $runtime = null,
        ?string $status = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $deploymentID && $self['deploymentID'] = $deploymentID;
        null !== $environment && $self['environment'] = $environment;
        null !== $runtime && $self['runtime'] = $runtime;
        null !== $status && $self['status'] = $status;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Deployment timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Unique deployment identifier.
     */
    public function withDeploymentID(string $deploymentID): self
    {
        $self = clone $this;
        $self['deploymentID'] = $deploymentID;

        return $self;
    }

    /**
     * Environment name.
     */
    public function withEnvironment(string $environment): self
    {
        $self = clone $this;
        $self['environment'] = $environment;

        return $self;
    }

    /**
     * Runtime used.
     */
    public function withRuntime(string $runtime): self
    {
        $self = clone $this;
        $self['runtime'] = $runtime;

        return $self;
    }

    /**
     * Deployment status.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Service endpoint URL (for web services).
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
