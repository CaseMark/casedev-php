<?php

declare(strict_types=1);

namespace Casedev\Actions\V1;

use Casedev\Actions\V1\V1ExecuteResponse\Status;
use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;
use Casedev\Core\Conversion\MapOf;

/**
 * @phpstan-type V1ExecuteResponseShape = array{
 *   duration_ms?: float|null,
 *   execution_id?: string|null,
 *   message?: string|null,
 *   output?: array<string,mixed>|null,
 *   status?: value-of<Status>|null,
 *   step_results?: list<array<string,mixed>>|null,
 *   webhook_configured?: bool|null,
 * }
 */
final class V1ExecuteResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<V1ExecuteResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Execution duration in milliseconds (only for completed executions).
     */
    #[Api(optional: true)]
    public ?float $duration_ms;

    /**
     * Unique identifier for this execution.
     */
    #[Api(optional: true)]
    public ?string $execution_id;

    /**
     * Human-readable status message.
     */
    #[Api(optional: true)]
    public ?string $message;

    /**
     * Final output (only for synchronous/completed executions).
     *
     * @var array<string,mixed>|null $output
     */
    #[Api(map: 'mixed', optional: true)]
    public ?array $output;

    /**
     * Current status of the execution.
     *
     * @var value-of<Status>|null $status
     */
    #[Api(enum: Status::class, optional: true)]
    public ?string $status;

    /**
     * Results from each step (only for synchronous/completed executions).
     *
     * @var list<array<string,mixed>>|null $step_results
     */
    #[Api(list: new MapOf('mixed'), optional: true)]
    public ?array $step_results;

    /**
     * Whether webhook notifications are configured.
     */
    #[Api(optional: true)]
    public ?bool $webhook_configured;

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
     * @param list<array<string,mixed>> $step_results
     */
    public static function with(
        ?float $duration_ms = null,
        ?string $execution_id = null,
        ?string $message = null,
        ?array $output = null,
        Status|string|null $status = null,
        ?array $step_results = null,
        ?bool $webhook_configured = null,
    ): self {
        $obj = new self;

        null !== $duration_ms && $obj['duration_ms'] = $duration_ms;
        null !== $execution_id && $obj['execution_id'] = $execution_id;
        null !== $message && $obj['message'] = $message;
        null !== $output && $obj['output'] = $output;
        null !== $status && $obj['status'] = $status;
        null !== $step_results && $obj['step_results'] = $step_results;
        null !== $webhook_configured && $obj['webhook_configured'] = $webhook_configured;

        return $obj;
    }

    /**
     * Execution duration in milliseconds (only for completed executions).
     */
    public function withDurationMs(float $durationMs): self
    {
        $obj = clone $this;
        $obj['duration_ms'] = $durationMs;

        return $obj;
    }

    /**
     * Unique identifier for this execution.
     */
    public function withExecutionID(string $executionID): self
    {
        $obj = clone $this;
        $obj['execution_id'] = $executionID;

        return $obj;
    }

    /**
     * Human-readable status message.
     */
    public function withMessage(string $message): self
    {
        $obj = clone $this;
        $obj['message'] = $message;

        return $obj;
    }

    /**
     * Final output (only for synchronous/completed executions).
     *
     * @param array<string,mixed> $output
     */
    public function withOutput(array $output): self
    {
        $obj = clone $this;
        $obj['output'] = $output;

        return $obj;
    }

    /**
     * Current status of the execution.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * Results from each step (only for synchronous/completed executions).
     *
     * @param list<array<string,mixed>> $stepResults
     */
    public function withStepResults(array $stepResults): self
    {
        $obj = clone $this;
        $obj['step_results'] = $stepResults;

        return $obj;
    }

    /**
     * Whether webhook notifications are configured.
     */
    public function withWebhookConfigured(bool $webhookConfigured): self
    {
        $obj = clone $this;
        $obj['webhook_configured'] = $webhookConfigured;

        return $obj;
    }
}
