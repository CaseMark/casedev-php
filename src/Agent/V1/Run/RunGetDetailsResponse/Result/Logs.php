<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunGetDetailsResponse\Result;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Sandbox execution logs (OpenCode server + runner script).
 *
 * @phpstan-type LogsShape = array{opencode?: string|null, runner?: string|null}
 */
final class Logs implements BaseModel
{
    /** @use SdkModel<LogsShape> */
    use SdkModel;

    /**
     * OpenCode server stdout/stderr.
     */
    #[Optional]
    public ?string $opencode;

    /**
     * Runner script stdout/stderr.
     */
    #[Optional]
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
        ?string $opencode = null,
        ?string $runner = null
    ): self {
        $self = new self;

        null !== $opencode && $self['opencode'] = $opencode;
        null !== $runner && $self['runner'] = $runner;

        return $self;
    }

    /**
     * OpenCode server stdout/stderr.
     */
    public function withOpencode(string $opencode): self
    {
        $self = clone $this;
        $self['opencode'] = $opencode;

        return $self;
    }

    /**
     * Runner script stdout/stderr.
     */
    public function withRunner(string $runner): self
    {
        $self = clone $this;
        $self['runner'] = $runner;

        return $self;
    }
}
