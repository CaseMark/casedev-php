<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Projects;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Get runtime/function logs for a project.
 *
 * @see CaseDev\Services\Applications\V1\ProjectsService::getRuntimeLogs()
 *
 * @phpstan-type ProjectGetRuntimeLogsParamsShape = array{limit?: float|null}
 */
final class ProjectGetRuntimeLogsParams implements BaseModel
{
    /** @use SdkModel<ProjectGetRuntimeLogsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Maximum number of logs to return.
     */
    #[Optional]
    public ?float $limit;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?float $limit = null): self
    {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Maximum number of logs to return.
     */
    public function withLimit(float $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
