<?php

declare(strict_types=1);

namespace Casedev\Applications\V1\Projects;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Get runtime/function logs for a project.
 *
 * @see Casedev\Services\Applications\V1\ProjectsService::getRuntimeLogs()
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
