<?php

declare(strict_types=1);

namespace Casedev\Projects\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Delete a project and all its associated deployments, environment variables, and domains.
 *
 * @see Casedev\Services\Projects\V1Service::delete()
 *
 * @phpstan-type V1DeleteParamsShape = array{deleteDeployments?: bool|null}
 */
final class V1DeleteParams implements BaseModel
{
    /** @use SdkModel<V1DeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Whether to also delete all deployments (default: true).
     */
    #[Optional]
    public ?bool $deleteDeployments;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $deleteDeployments = null): self
    {
        $self = new self;

        null !== $deleteDeployments && $self['deleteDeployments'] = $deleteDeployments;

        return $self;
    }

    /**
     * Whether to also delete all deployments (default: true).
     */
    public function withDeleteDeployments(bool $deleteDeployments): self
    {
        $self = clone $this;
        $self['deleteDeployments'] = $deleteDeployments;

        return $self;
    }
}
