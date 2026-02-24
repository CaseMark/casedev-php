<?php

declare(strict_types=1);

namespace CaseDev\Database\V1\Projects;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProjectGetConnectionResponseShape = array{
 *   branch: string, connectionUri: string, pooled: bool
 * }
 */
final class ProjectGetConnectionResponse implements BaseModel
{
    /** @use SdkModel<ProjectGetConnectionResponseShape> */
    use SdkModel;

    /**
     * Branch name for this connection.
     */
    #[Required]
    public string $branch;

    /**
     * PostgreSQL connection string (includes credentials).
     */
    #[Required]
    public string $connectionUri;

    /**
     * Whether this is a pooled connection.
     */
    #[Required]
    public bool $pooled;

    /**
     * `new ProjectGetConnectionResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectGetConnectionResponse::with(branch: ..., connectionUri: ..., pooled: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectGetConnectionResponse)
     *   ->withBranch(...)
     *   ->withConnectionUri(...)
     *   ->withPooled(...)
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
     */
    public static function with(
        string $branch,
        string $connectionUri,
        bool $pooled
    ): self {
        $self = new self;

        $self['branch'] = $branch;
        $self['connectionUri'] = $connectionUri;
        $self['pooled'] = $pooled;

        return $self;
    }

    /**
     * Branch name for this connection.
     */
    public function withBranch(string $branch): self
    {
        $self = clone $this;
        $self['branch'] = $branch;

        return $self;
    }

    /**
     * PostgreSQL connection string (includes credentials).
     */
    public function withConnectionUri(string $connectionUri): self
    {
        $self = clone $this;
        $self['connectionUri'] = $connectionUri;

        return $self;
    }

    /**
     * Whether this is a pooled connection.
     */
    public function withPooled(bool $pooled): self
    {
        $self = clone $this;
        $self['pooled'] = $pooled;

        return $self;
    }
}
