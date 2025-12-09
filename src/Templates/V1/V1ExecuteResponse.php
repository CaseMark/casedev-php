<?php

declare(strict_types=1);

namespace Casedev\Templates\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Templates\V1\V1ExecuteResponse\Status;
use Casedev\Templates\V1\V1ExecuteResponse\Usage;

/**
 * @phpstan-type V1ExecuteResponseShape = array{
 *   result?: mixed,
 *   status?: value-of<Status>|null,
 *   usage?: Usage|null,
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
     * @param Status|value-of<Status> $status
     * @param Usage|array{
     *   completionTokens?: int|null,
     *   cost?: float|null,
     *   promptTokens?: int|null,
     *   totalTokens?: int|null,
     * } $usage
     */
    public static function with(
        mixed $result = null,
        Status|string|null $status = null,
        Usage|array|null $usage = null,
        ?string $workflowName = null,
    ): self {
        $obj = new self;

        null !== $result && $obj['result'] = $result;
        null !== $status && $obj['status'] = $status;
        null !== $usage && $obj['usage'] = $usage;
        null !== $workflowName && $obj['workflowName'] = $workflowName;

        return $obj;
    }

    /**
     * Workflow output (structure varies by workflow type).
     */
    public function withResult(mixed $result): self
    {
        $obj = clone $this;
        $obj['result'] = $result;

        return $obj;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * @param Usage|array{
     *   completionTokens?: int|null,
     *   cost?: float|null,
     *   promptTokens?: int|null,
     *   totalTokens?: int|null,
     * } $usage
     */
    public function withUsage(Usage|array $usage): self
    {
        $obj = clone $this;
        $obj['usage'] = $usage;

        return $obj;
    }

    /**
     * Name of the executed workflow.
     */
    public function withWorkflowName(string $workflowName): self
    {
        $obj = clone $this;
        $obj['workflowName'] = $workflowName;

        return $obj;
    }
}
