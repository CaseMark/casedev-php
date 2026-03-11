<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Projects;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Soft-deletes an application project or deployed Thurgood app from Case.dev. By default it also removes the linked hosting project; set deleteFromHosting=false to keep the external hosting resources intact.
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
     * Whether to also delete the linked hosting project. Defaults to true.
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
     * Whether to also delete the linked hosting project. Defaults to true.
     */
    public function withDeleteFromHosting(bool $deleteFromHosting): self
    {
        $self = clone $this;
        $self['deleteFromHosting'] = $deleteFromHosting;

        return $self;
    }
}
