<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Workflows;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Get current deployment workflow status and accumulated events.
 *
 * @see CaseDev\Services\Applications\V1\WorkflowsService::getStatus()
 *
 * @phpstan-type WorkflowGetStatusParamsShape = array{projectID: string}
 */
final class WorkflowGetStatusParams implements BaseModel
{
    /** @use SdkModel<WorkflowGetStatusParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Project ID (for authorization).
     */
    #[Required]
    public string $projectID;

    /**
     * `new WorkflowGetStatusParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkflowGetStatusParams::with(projectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkflowGetStatusParams)->withProjectID(...)
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
