<?php

declare(strict_types=1);

namespace Router\Applications\V1\Deployments;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Get details of a specific deployment including build logs.
 *
 * @see Router\Services\Applications\V1\DeploymentsService::retrieve()
 *
 * @phpstan-type DeploymentRetrieveParamsShape = array{
 *   projectID: string, includeLogs?: bool|null
 * }
 */
final class DeploymentRetrieveParams implements BaseModel
{
    /** @use SdkModel<DeploymentRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Project ID (for authorization).
     */
    #[Required]
    public string $projectID;

    /**
     * Include build logs.
     */
    #[Optional]
    public ?bool $includeLogs;

    /**
     * `new DeploymentRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeploymentRetrieveParams::with(projectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeploymentRetrieveParams)->withProjectID(...)
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
        string $projectID,
        ?bool $includeLogs = null
    ): self {
        $self = new self;

        $self['projectID'] = $projectID;

        null !== $includeLogs && $self['includeLogs'] = $includeLogs;

        return $self;
    }

    /**
     * Project ID (for authorization).
     */
    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * Include build logs.
     */
    public function withIncludeLogs(bool $includeLogs): self
    {
        $self = clone $this;
        $self['includeLogs'] = $includeLogs;

        return $self;
    }
}
