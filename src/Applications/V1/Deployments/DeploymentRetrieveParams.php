<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Deployments;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Returns deployment details for one project in the authenticated organization. Set includeLogs=true to include recent build output in the response.
 *
 * @see CaseDev\Services\Applications\V1\DeploymentsService::retrieve()
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
     * Project ID used to verify access to the deployment.
     */
    #[Required]
    public string $projectID;

    /**
     * Whether to include build logs in the response.
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
     * Project ID used to verify access to the deployment.
     */
    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * Whether to include build logs in the response.
     */
    public function withIncludeLogs(bool $includeLogs): self
    {
        $self = clone $this;
        $self['includeLogs'] = $includeLogs;

        return $self;
    }
}
