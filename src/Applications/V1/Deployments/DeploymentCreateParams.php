<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Deployments;

use CaseDev\Applications\V1\Deployments\DeploymentCreateParams\Target;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Creates a deployment for an existing project by fetching repository files from GitHub and uploading them to the hosting provider. Use ref to deploy a branch, tag, or commit other than the project default branch.
 *
 * @see CaseDev\Services\Applications\V1\DeploymentsService::create()
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
     * Project ID to deploy.
     */
    #[Required('projectId')]
    public string $projectID;

    /**
     * Git branch, tag, or commit to deploy. Defaults to the project branch.
     */
    #[Optional]
    public ?string $ref;

    /**
     * Deployment target environment.
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
     * Project ID to deploy.
     */
    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * Git branch, tag, or commit to deploy. Defaults to the project branch.
     */
    public function withRef(string $ref): self
    {
        $self = clone $this;
        $self['ref'] = $ref;

        return $self;
    }

    /**
     * Deployment target environment.
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
