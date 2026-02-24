<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Deployments;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Stream real-time deployment progress events via Server-Sent Events.
 *
 * @see CaseDev\Services\Applications\V1\DeploymentsService::stream()
 *
 * @phpstan-type DeploymentStreamParamsShape = array{
 *   projectID: string, startIndex?: float|null
 * }
 */
final class DeploymentStreamParams implements BaseModel
{
    /** @use SdkModel<DeploymentStreamParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Project ID (for authorization).
     */
    #[Required]
    public string $projectID;

    /**
     * Resume stream from this index (for reconnection).
     */
    #[Optional]
    public ?float $startIndex;

    /**
     * `new DeploymentStreamParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeploymentStreamParams::with(projectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeploymentStreamParams)->withProjectID(...)
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
        ?float $startIndex = null
    ): self {
        $self = new self;

        $self['projectID'] = $projectID;

        null !== $startIndex && $self['startIndex'] = $startIndex;

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
     * Resume stream from this index (for reconnection).
     */
    public function withStartIndex(float $startIndex): self
    {
        $self = clone $this;
        $self['startIndex'] = $startIndex;

        return $self;
    }
}
