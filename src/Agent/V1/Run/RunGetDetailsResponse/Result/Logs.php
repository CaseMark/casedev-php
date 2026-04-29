<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunGetDetailsResponse\Result;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Sandbox execution logs (runtime server + runner script).
 *
 * @phpstan-type LogsShape = array{
 *   opencode?: string|null, runner?: string|null, runtime?: string|null
 * }
 */
final class Logs implements BaseModel
{
    /** @use SdkModel<LogsShape> */
    use SdkModel;

    /**
     * Legacy runtime server stdout/stderr.
     */
    #[Optional]
    public ?string $opencode;

    /**
     * Runner script stdout/stderr.
     */
    #[Optional]
    public ?string $runner;

    /**
     * Runtime server stdout/stderr.
     */
    #[Optional]
    public ?string $runtime;

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
        ?string $runner = null,
        ?string $runtime = null
    ): self {
        $self = new self;

        null !== $opencode && $self['opencode'] = $opencode;
        null !== $runner && $self['runner'] = $runner;
        null !== $runtime && $self['runtime'] = $runtime;

        return $self;
    }

    /**
     * Legacy runtime server stdout/stderr.
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

    /**
     * Runtime server stdout/stderr.
     */
    public function withRuntime(string $runtime): self
    {
        $self = clone $this;
        $self['runtime'] = $runtime;

        return $self;
    }
}
