<?php

declare(strict_types=1);

namespace Router\Applications\V1\Projects;

use Router\Applications\V1\Projects\ProjectListDeploymentsParams\Target;
use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * List deployments for a specific project.
 *
 * @see Router\Services\Applications\V1\ProjectsService::listDeployments()
 *
 * @phpstan-type ProjectListDeploymentsParamsShape = array{
 *   limit?: float|null, state?: string|null, target?: null|Target|value-of<Target>
 * }
 */
final class ProjectListDeploymentsParams implements BaseModel
{
    /** @use SdkModel<ProjectListDeploymentsParamsShape> */
    use SdkModel;
    use SdkParams;

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
        ?float $limit = null,
        ?string $state = null,
        Target|string|null $target = null
    ): self {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $state && $self['state'] = $state;
        null !== $target && $self['target'] = $target;

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
