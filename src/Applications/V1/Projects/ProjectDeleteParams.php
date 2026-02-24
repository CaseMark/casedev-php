<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Projects;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Delete a web application project.
 *
 * @see CaseDev\Services\Applications\V1\ProjectsService::delete()
 *
 * @phpstan-type ProjectDeleteParamsShape = array{deleteFromHosting?: bool|null}
 */
final class ProjectDeleteParams implements BaseModel
{
    /** @use SdkModel<ProjectDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Also delete the project from hosting (default: true).
     */
    #[Optional]
    public ?bool $deleteFromHosting;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $deleteFromHosting = null): self
    {
        $self = new self;

        null !== $deleteFromHosting && $self['deleteFromHosting'] = $deleteFromHosting;

        return $self;
    }

    /**
     * Also delete the project from hosting (default: true).
     */
    public function withDeleteFromHosting(bool $deleteFromHosting): self
    {
        $self = clone $this;
        $self['deleteFromHosting'] = $deleteFromHosting;

        return $self;
    }
}
