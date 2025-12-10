<?php

declare(strict_types=1);

namespace Casedev\Actions\V1;

use Casedev\Actions\V1\V1ExecuteResponse\Status;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\MapOf;

/**
 * @phpstan-type V1ExecuteResponseShape = array{
 *   durationMs?: float|null,
 *   executionID?: string|null,
 *   message?: string|null,
 *   output?: array<string,mixed>|null,
 *   status?: value-of<Status>|null,
 *   stepResults?: list<array<string,mixed>>|null,
 *   webhookConfigured?: bool|null,
 * }
 */
final class V1ExecuteResponse implements BaseModel
{
    /** @use SdkModel<V1ExecuteResponseShape> */
    use SdkModel;

    /**
     * Execution duration in milliseconds (only for completed executions).
     */
    #[Optional('duration_ms')]
    public ?float $durationMs;

    /**
     * Unique identifier for this execution.
     */
    #[Optional('execution_id')]
    public ?string $executionID;

    /**
     * Human-readable status message.
     */
    #[Optional]
    public ?string $message;

    /**
     * Final output (only for synchronous/completed executions).
     *
     * @var array<string,mixed>|null $output
     */
    #[Optional(map: 'mixed')]
    public ?array $output;

    /**
     * Current status of the execution.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Results from each step (only for synchronous/completed executions).
     *
     * @var list<array<string,mixed>>|null $stepResults
     */
    #[Optional('step_results', list: new MapOf('mixed'))]
    public ?array $stepResults;

    /**
     * Whether webhook notifications are configured.
     */
    #[Optional('webhook_configured')]
    public ?bool $webhookConfigured;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed> $output
     * @param Status|value-of<Status> $status
     * @param list<array<string,mixed>> $stepResults
     */
    public static function with(
        ?float $durationMs = null,
        ?string $executionID = null,
        ?string $message = null,
        ?array $output = null,
        Status|string|null $status = null,
        ?array $stepResults = null,
        ?bool $webhookConfigured = null,
    ): self {
        $self = new self;

        null !== $durationMs && $self['durationMs'] = $durationMs;
        null !== $executionID && $self['executionID'] = $executionID;
        null !== $message && $self['message'] = $message;
        null !== $output && $self['output'] = $output;
        null !== $status && $self['status'] = $status;
        null !== $stepResults && $self['stepResults'] = $stepResults;
        null !== $webhookConfigured && $self['webhookConfigured'] = $webhookConfigured;

        return $self;
    }

    /**
     * Execution duration in milliseconds (only for completed executions).
     */
    public function withDurationMs(float $durationMs): self
    {
        $self = clone $this;
        $self['durationMs'] = $durationMs;

        return $self;
    }

    /**
     * Unique identifier for this execution.
     */
    public function withExecutionID(string $executionID): self
    {
        $self = clone $this;
        $self['executionID'] = $executionID;

        return $self;
    }

    /**
     * Human-readable status message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Final output (only for synchronous/completed executions).
     *
     * @param array<string,mixed> $output
     */
    public function withOutput(array $output): self
    {
        $self = clone $this;
        $self['output'] = $output;

        return $self;
    }

    /**
     * Current status of the execution.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Results from each step (only for synchronous/completed executions).
     *
     * @param list<array<string,mixed>> $stepResults
     */
    public function withStepResults(array $stepResults): self
    {
        $self = clone $this;
        $self['stepResults'] = $stepResults;

        return $self;
    }

    /**
     * Whether webhook notifications are configured.
     */
    public function withWebhookConfigured(bool $webhookConfigured): self
    {
        $self = clone $this;
        $self['webhookConfigured'] = $webhookConfigured;

        return $self;
    }
}
