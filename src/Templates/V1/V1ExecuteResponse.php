<?php

declare(strict_types=1);

namespace Casedev\Templates\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Templates\V1\V1ExecuteResponse\Status;
use Casedev\Templates\V1\V1ExecuteResponse\Usage;

/**
 * @phpstan-import-type UsageShape from \Casedev\Templates\V1\V1ExecuteResponse\Usage
 *
 * @phpstan-type V1ExecuteResponseShape = array{
 *   result?: mixed,
 *   status?: null|Status|value-of<Status>,
 *   usage?: null|Usage|UsageShape,
 *   workflowName?: string|null,
 * }
 */
final class V1ExecuteResponse implements BaseModel
{
    /** @use SdkModel<V1ExecuteResponseShape> */
    use SdkModel;

    /**
     * Workflow output (structure varies by workflow type).
     */
    #[Optional]
    public mixed $result;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    #[Optional]
    public ?Usage $usage;

    /**
     * Name of the executed workflow.
     */
    #[Optional('workflow_name')]
    public ?string $workflowName;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     * @param Usage|UsageShape|null $usage
     */
    public static function with(
        mixed $result = null,
        Status|string|null $status = null,
        Usage|array|null $usage = null,
        ?string $workflowName = null,
    ): self {
        $self = new self;

        null !== $result && $self['result'] = $result;
        null !== $status && $self['status'] = $status;
        null !== $usage && $self['usage'] = $usage;
        null !== $workflowName && $self['workflowName'] = $workflowName;

        return $self;
    }

    /**
     * Workflow output (structure varies by workflow type).
     */
    public function withResult(mixed $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * @param Usage|UsageShape $usage
     */
    public function withUsage(Usage|array $usage): self
    {
        $self = clone $this;
        $self['usage'] = $usage;

        return $self;
    }

    /**
     * Name of the executed workflow.
     */
    public function withWorkflowName(string $workflowName): self
    {
        $self = clone $this;
        $self['workflowName'] = $workflowName;

        return $self;
    }
}
