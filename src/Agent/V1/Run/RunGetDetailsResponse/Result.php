<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunGetDetailsResponse;

use CaseDev\Agent\V1\Run\RunGetDetailsResponse\Result\FinalResponse;
use CaseDev\Agent\V1\Run\RunGetDetailsResponse\Result\Logs;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Final output from the agent.
 *
 * @phpstan-import-type FinalResponseShape from \CaseDev\Agent\V1\Run\RunGetDetailsResponse\Result\FinalResponse
 * @phpstan-import-type LogsShape from \CaseDev\Agent\V1\Run\RunGetDetailsResponse\Result\Logs
 *
 * @phpstan-type ResultShape = array{
 *   finalResponse?: null|FinalResponse|FinalResponseShape,
 *   logs?: null|Logs|LogsShape,
 *   output?: string|null,
 *   outputObjectIDs?: list<string>|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Compact agent-facing result summary and execution issues.
     */
    #[Optional(nullable: true)]
    public ?FinalResponse $finalResponse;

    /**
     * Sandbox execution logs (runtime server + runner script).
     */
    #[Optional(nullable: true)]
    public ?Logs $logs;

    #[Optional]
    public ?string $output;

    /** @var list<string>|null $outputObjectIDs */
    #[Optional('outputObjectIds', list: 'string')]
    public ?array $outputObjectIDs;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param FinalResponse|FinalResponseShape|null $finalResponse
     * @param Logs|LogsShape|null $logs
     * @param list<string>|null $outputObjectIDs
     */
    public static function with(
        FinalResponse|array|null $finalResponse = null,
        Logs|array|null $logs = null,
        ?string $output = null,
        ?array $outputObjectIDs = null,
    ): self {
        $self = new self;

        null !== $finalResponse && $self['finalResponse'] = $finalResponse;
        null !== $logs && $self['logs'] = $logs;
        null !== $output && $self['output'] = $output;
        null !== $outputObjectIDs && $self['outputObjectIDs'] = $outputObjectIDs;

        return $self;
    }

    /**
     * Compact agent-facing result summary and execution issues.
     *
     * @param FinalResponse|FinalResponseShape|null $finalResponse
     */
    public function withFinalResponse(
        FinalResponse|array|null $finalResponse
    ): self {
        $self = clone $this;
        $self['finalResponse'] = $finalResponse;

        return $self;
    }

    /**
     * Sandbox execution logs (runtime server + runner script).
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

    /**
     * @param list<string> $outputObjectIDs
     */
    public function withOutputObjectIDs(array $outputObjectIDs): self
    {
        $self = clone $this;
        $self['outputObjectIDs'] = $outputObjectIDs;

        return $self;
    }
}
