<?php

declare(strict_types=1);

namespace Router\Applications\V1\Deployments;

use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Get build logs for a specific deployment.
 *
 * @see Router\Services\Applications\V1\DeploymentsService::getLogs()
 *
 * @phpstan-type DeploymentGetLogsParamsShape = array{projectID: string}
 */
final class DeploymentGetLogsParams implements BaseModel
{
    /** @use SdkModel<DeploymentGetLogsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Project ID (for authorization).
     */
    #[Required]
    public string $projectID;

    /**
     * `new DeploymentGetLogsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeploymentGetLogsParams::with(projectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeploymentGetLogsParams)->withProjectID(...)
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
    public static function with(string $projectID): self
    {
        $self = new self;

        $self['projectID'] = $projectID;

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
}
