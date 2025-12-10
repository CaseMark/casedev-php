<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

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
 *   workflowID?: string|null,
 * }
 */
final class V1GetExecutionResponse implements BaseModel
{
    /** @use SdkModel<V1GetExecutionResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?string $completedAt;

    #[Optional]
    public ?int $durationMs;

    #[Optional]
    public ?string $error;

    #[Optional]
    public mixed $input;

    #[Optional]
    public mixed $output;

    #[Optional]
    public ?string $startedAt;

    #[Optional]
    public ?string $status;

    #[Optional]
    public ?string $triggerType;

    #[Optional('workflowId')]
    public ?string $workflowID;

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
        ?string $workflowID = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $durationMs && $self['durationMs'] = $durationMs;
        null !== $error && $self['error'] = $error;
        null !== $input && $self['input'] = $input;
        null !== $output && $self['output'] = $output;
        null !== $startedAt && $self['startedAt'] = $startedAt;
        null !== $status && $self['status'] = $status;
        null !== $triggerType && $self['triggerType'] = $triggerType;
        null !== $workflowID && $self['workflowID'] = $workflowID;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCompletedAt(string $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

        return $self;
    }

    public function withDurationMs(int $durationMs): self
    {
        $self = clone $this;
        $self['durationMs'] = $durationMs;

        return $self;
    }

    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    public function withInput(mixed $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    public function withOutput(mixed $output): self
    {
        $self = clone $this;
        $self['output'] = $output;

        return $self;
    }

    public function withStartedAt(string $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withTriggerType(string $triggerType): self
    {
        $self = clone $this;
        $self['triggerType'] = $triggerType;

        return $self;
    }

    public function withWorkflowID(string $workflowID): self
    {
        $self = clone $this;
        $self['workflowID'] = $workflowID;

        return $self;
    }
}
