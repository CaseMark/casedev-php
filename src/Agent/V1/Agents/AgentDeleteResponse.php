<?php

declare(strict_types=1);

namespace Router\Agent\V1\Agents;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type AgentDeleteResponseShape = array{ok?: bool|null}
 */
final class AgentDeleteResponse implements BaseModel
{
    /** @use SdkModel<AgentDeleteResponseShape> */
    use SdkModel;

    #[Optional]
    public ?bool $ok;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $ok = null): self
    {
        $self = new self;

        null !== $ok && $self['ok'] = $ok;

        return $self;
    }

    public function withOk(bool $ok): self
    {
        $self = clone $this;
        $self['ok'] = $ok;

        return $self;
    }
}
