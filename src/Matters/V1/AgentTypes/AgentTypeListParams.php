<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\AgentTypes;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * List reusable agent roles for the authenticated organization.
 *
 * @see CaseDev\Services\Matters\V1\AgentTypesService::list()
 *
 * @phpstan-type AgentTypeListParamsShape = array{active?: bool|null}
 */
final class AgentTypeListParams implements BaseModel
{
    /** @use SdkModel<AgentTypeListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?bool $active;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $active = null): self
    {
        $self = new self;

        null !== $active && $self['active'] = $active;

        return $self;
    }

    public function withActive(bool $active): self
    {
        $self = clone $this;
        $self['active'] = $active;

        return $self;
    }
}
