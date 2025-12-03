<?php

declare(strict_types=1);

namespace Casedev\Templates\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;
use Casedev\Templates\V1\V1ExecuteResponse\Status;
use Casedev\Templates\V1\V1ExecuteResponse\Usage;

/**
 * @phpstan-type V1ExecuteResponseShape = array{
 *   result?: mixed,
 *   status?: value-of<Status>|null,
 *   usage?: Usage|null,
 *   workflow_name?: string|null,
 * }
 */
final class V1ExecuteResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<V1ExecuteResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Workflow output (structure varies by workflow type).
     */
    #[Api(optional: true)]
    public mixed $result;

    /** @var value-of<Status>|null $status */
    #[Api(enum: Status::class, optional: true)]
    public ?string $status;

    #[Api(optional: true)]
    public ?Usage $usage;

    /**
     * Name of the executed workflow.
     */
    #[Api(optional: true)]
    public ?string $workflow_name;

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
     */
    public static function with(
        mixed $result = null,
        Status|string|null $status = null,
        ?Usage $usage = null,
        ?string $workflow_name = null,
    ): self {
        $obj = new self;

        null !== $result && $obj->result = $result;
        null !== $status && $obj['status'] = $status;
        null !== $usage && $obj->usage = $usage;
        null !== $workflow_name && $obj->workflow_name = $workflow_name;

        return $obj;
    }

    /**
     * Workflow output (structure varies by workflow type).
     */
    public function withResult(mixed $result): self
    {
        $obj = clone $this;
        $obj->result = $result;

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

    public function withUsage(Usage $usage): self
    {
        $obj = clone $this;
        $obj->usage = $usage;

        return $obj;
    }

    /**
     * Name of the executed workflow.
     */
    public function withWorkflowName(string $workflowName): self
    {
        $obj = clone $this;
        $obj->workflow_name = $workflowName;

        return $obj;
    }
}
