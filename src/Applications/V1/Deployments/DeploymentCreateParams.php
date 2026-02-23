<?php

declare(strict_types=1);

namespace Router\Applications\V1\Deployments;

use Router\Applications\V1\Deployments\DeploymentCreateParams\Target;
use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Trigger a new deployment for a project.
 *
 * @see Router\Services\Applications\V1\DeploymentsService::create()
 *
 * @phpstan-type DeploymentCreateParamsShape = array{
 *   projectID: string, ref?: string|null, target?: null|Target|value-of<Target>
 * }
 */
final class DeploymentCreateParams implements BaseModel
{
    /** @use SdkModel<DeploymentCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Project ID.
     */
    #[Required('projectId')]
    public string $projectID;

    /**
     * Git ref (branch, tag, or commit) to deploy.
     */
    #[Optional]
    public ?string $ref;

    /**
     * Deployment target.
     *
     * @var value-of<Target>|null $target
     */
    #[Optional(enum: Target::class)]
    public ?string $target;

    /**
     * `new DeploymentCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeploymentCreateParams::with(projectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeploymentCreateParams)->withProjectID(...)
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
     * @param Target|value-of<Target>|null $target
     */
    public static function with(
        string $projectID,
        ?string $ref = null,
        Target|string|null $target = null
    ): self {
        $self = new self;

        $self['projectID'] = $projectID;

        null !== $ref && $self['ref'] = $ref;
        null !== $target && $self['target'] = $target;

        return $self;
    }

    /**
     * Project ID.
     */
    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * Git ref (branch, tag, or commit) to deploy.
     */
    public function withRef(string $ref): self
    {
        $self = clone $this;
        $self['ref'] = $ref;

        return $self;
    }

    /**
     * Deployment target.
     *
     * @param Target|value-of<Target> $target
     */
    public function withTarget(Target|string $target): self
    {
        $self = clone $this;
        $self['target'] = $target;

        return $self;
    }
}
