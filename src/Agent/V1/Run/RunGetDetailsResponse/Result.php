<?php

declare(strict_types=1);

namespace Router\Agent\V1\Run\RunGetDetailsResponse;

use Router\Agent\V1\Run\RunGetDetailsResponse\Result\Logs;
use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * Final output from the agent.
 *
 * @phpstan-import-type LogsShape from \Router\Agent\V1\Run\RunGetDetailsResponse\Result\Logs
 *
 * @phpstan-type ResultShape = array{
 *   logs?: null|Logs|LogsShape, output?: string|null
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Sandbox execution logs (OpenCode server + runner script).
     */
    #[Optional(nullable: true)]
    public ?Logs $logs;

    #[Optional]
    public ?string $output;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Logs|LogsShape|null $logs
     */
    public static function with(
        Logs|array|null $logs = null,
        ?string $output = null
    ): self {
        $self = new self;

        null !== $logs && $self['logs'] = $logs;
        null !== $output && $self['output'] = $output;

        return $self;
    }

    /**
     * Sandbox execution logs (OpenCode server + runner script).
     *
     * @param Logs|LogsShape|null $logs
     */
    public function withLogs(Logs|array|null $logs): self
    {
        $self = clone $this;
        $self['logs'] = $logs;

        return $self;
    }

    public function withOutput(string $output): self
    {
        $self = clone $this;
        $self['output'] = $output;

        return $self;
    }
}
