<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Execute\ExecuteNewResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type LogsShape = array{linc?: string|null, runner?: string|null}
 */
final class Logs implements BaseModel
{
    /** @use SdkModel<LogsShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $linc;

    #[Optional(nullable: true)]
    public ?string $runner;

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
        ?string $linc = null,
        ?string $runner = null
    ): self {
        $self = new self;

        null !== $linc && $self['linc'] = $linc;
        null !== $runner && $self['runner'] = $runner;

        return $self;
    }

    public function withLinc(?string $linc): self
    {
        $self = clone $this;
        $self['linc'] = $linc;

        return $self;
    }

    public function withRunner(?string $runner): self
    {
        $self = clone $this;
        $self['runner'] = $runner;

        return $self;
    }
}
