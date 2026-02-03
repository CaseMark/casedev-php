<?php

declare(strict_types=1);

namespace Casedev\Applications\V1\Deployments;

use Casedev\Applications\V1\Deployments\DeploymentListParams\Target;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * List deployments for a project.
 *
 * @see Casedev\Services\Applications\V1\DeploymentsService::list()
 *
 * @phpstan-type DeploymentListParamsShape = array{
 *   projectID: string,
 *   limit?: float|null,
 *   state?: string|null,
 *   target?: null|Target|value-of<Target>,
 * }
 */
final class DeploymentListParams implements BaseModel
{
    /** @use SdkModel<DeploymentListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Project ID.
     */
    #[Required]
    public string $projectID;

    /**
     * Maximum number of deployments to return.
     */
    #[Optional]
    public ?float $limit;

    /**
     * Filter by deployment state.
     */
    #[Optional]
    public ?string $state;

    /**
     * Filter by deployment target.
     *
     * @var value-of<Target>|null $target
     */
    #[Optional(enum: Target::class)]
    public ?string $target;

    /**
     * `new DeploymentListParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeploymentListParams::with(projectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeploymentListParams)->withProjectID(...)
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
        ?float $limit = null,
        ?string $state = null,
        Target|string|null $target = null,
    ): self {
        $self = new self;

        $self['projectID'] = $projectID;

        null !== $limit && $self['limit'] = $limit;
        null !== $state && $self['state'] = $state;
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
     * Maximum number of deployments to return.
     */
    public function withLimit(float $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter by deployment state.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * Filter by deployment target.
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
