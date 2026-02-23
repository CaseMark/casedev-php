<?php

declare(strict_types=1);

namespace Router\Database\V1\Projects;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Retrieves the PostgreSQL connection URI for a database project. Supports selecting specific branches and pooled vs direct connections. Connection strings include credentials and should be stored securely. Use for configuring applications and deployment environments.
 *
 * @see Router\Services\Database\V1\ProjectsService::getConnection()
 *
 * @phpstan-type ProjectGetConnectionParamsShape = array{
 *   branch?: string|null, pooled?: bool|null
 * }
 */
final class ProjectGetConnectionParams implements BaseModel
{
    /** @use SdkModel<ProjectGetConnectionParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Branch name (defaults to 'main').
     */
    #[Optional]
    public ?string $branch;

    /**
     * Use pooled connection (PgBouncer).
     */
    #[Optional]
    public ?bool $pooled;

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
        ?string $branch = null,
        ?bool $pooled = null
    ): self {
        $self = new self;

        null !== $branch && $self['branch'] = $branch;
        null !== $pooled && $self['pooled'] = $pooled;

        return $self;
    }

    /**
     * Branch name (defaults to 'main').
     */
    public function withBranch(string $branch): self
    {
        $self = clone $this;
        $self['branch'] = $branch;

        return $self;
    }

    /**
     * Use pooled connection (PgBouncer).
     */
    public function withPooled(bool $pooled): self
    {
        $self = clone $this;
        $self['pooled'] = $pooled;

        return $self;
    }
}
