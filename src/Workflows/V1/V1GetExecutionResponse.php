<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type V1GetExecutionResponseShape = array{
 *   id?: string|null,
 *   completedAt?: string|null,
 *   durationMs?: int|null,
 *   error?: string|null,
 *   input?: mixed,
 *   output?: mixed,
 *   startedAt?: string|null,
 *   status?: string|null,
 *   triggerType?: string|null,
 *   workflowId?: string|null,
 * }
 */
final class V1GetExecutionResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<V1GetExecutionResponseShape> */
    use SdkModel;

    use SdkResponse;

    #[Api(optional: true)]
    public ?string $id;

    #[Api(optional: true)]
    public ?string $completedAt;

    #[Api(optional: true)]
    public ?int $durationMs;

    #[Api(optional: true)]
    public ?string $error;

    #[Api(optional: true)]
    public mixed $input;

    #[Api(optional: true)]
    public mixed $output;

    #[Api(optional: true)]
    public ?string $startedAt;

    #[Api(optional: true)]
    public ?string $status;

    #[Api(optional: true)]
    public ?string $triggerType;

    #[Api(optional: true)]
    public ?string $workflowId;

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
        ?string $id = null,
        ?string $completedAt = null,
        ?int $durationMs = null,
        ?string $error = null,
        mixed $input = null,
        mixed $output = null,
        ?string $startedAt = null,
        ?string $status = null,
        ?string $triggerType = null,
        ?string $workflowId = null,
    ): self {
        $obj = new self;

        null !== $id && $obj->id = $id;
        null !== $completedAt && $obj->completedAt = $completedAt;
        null !== $durationMs && $obj->durationMs = $durationMs;
        null !== $error && $obj->error = $error;
        null !== $input && $obj->input = $input;
        null !== $output && $obj->output = $output;
        null !== $startedAt && $obj->startedAt = $startedAt;
        null !== $status && $obj->status = $status;
        null !== $triggerType && $obj->triggerType = $triggerType;
        null !== $workflowId && $obj->workflowId = $workflowId;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    public function withCompletedAt(string $completedAt): self
    {
        $obj = clone $this;
        $obj->completedAt = $completedAt;

        return $obj;
    }

    public function withDurationMs(int $durationMs): self
    {
        $obj = clone $this;
        $obj->durationMs = $durationMs;

        return $obj;
    }

    public function withError(string $error): self
    {
        $obj = clone $this;
        $obj->error = $error;

        return $obj;
    }

    public function withInput(mixed $input): self
    {
        $obj = clone $this;
        $obj->input = $input;

        return $obj;
    }

    public function withOutput(mixed $output): self
    {
        $obj = clone $this;
        $obj->output = $output;

        return $obj;
    }

    public function withStartedAt(string $startedAt): self
    {
        $obj = clone $this;
        $obj->startedAt = $startedAt;

        return $obj;
    }

    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }

    public function withTriggerType(string $triggerType): self
    {
        $obj = clone $this;
        $obj->triggerType = $triggerType;

        return $obj;
    }

    public function withWorkflowID(string $workflowID): self
    {
        $obj = clone $this;
        $obj->workflowId = $workflowID;

        return $obj;
    }
}
