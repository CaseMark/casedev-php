<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Deployments;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Cancel a running deployment.
 *
 * @see CaseDev\Services\Applications\V1\DeploymentsService::cancel()
 *
 * @phpstan-type DeploymentCancelParamsShape = array{projectID: string}
 */
final class DeploymentCancelParams implements BaseModel
{
    /** @use SdkModel<DeploymentCancelParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Project ID (for authorization).
     */
    #[Required('projectId')]
    public string $projectID;

    /**
     * `new DeploymentCancelParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeploymentCancelParams::with(projectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeploymentCancelParams)->withProjectID(...)
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
