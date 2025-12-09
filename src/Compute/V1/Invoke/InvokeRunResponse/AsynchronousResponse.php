<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Invoke\InvokeRunResponse;

use Casedev\Compute\V1\Invoke\InvokeRunResponse\AsynchronousResponse\Status;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type AsynchronousResponseShape = array{
 *   logsUrl?: string|null, runId?: string|null, status?: value-of<Status>|null
 * }
 */
final class AsynchronousResponse implements BaseModel
{
    /** @use SdkModel<AsynchronousResponseShape> */
    use SdkModel;

    /**
     * URL to check run status and logs.
     */
    #[Optional]
    public ?string $logsUrl;

    /**
     * Unique run identifier.
     */
    #[Optional]
    public ?string $runId;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

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
        ?string $logsUrl = null,
        ?string $runId = null,
        Status|string|null $status = null
    ): self {
        $obj = new self;

        null !== $logsUrl && $obj['logsUrl'] = $logsUrl;
        null !== $runId && $obj['runId'] = $runId;
        null !== $status && $obj['status'] = $status;

        return $obj;
    }

    /**
     * URL to check run status and logs.
     */
    public function withLogsURL(string $logsURL): self
    {
        $obj = clone $this;
        $obj['logsUrl'] = $logsURL;

        return $obj;
    }

    /**
     * Unique run identifier.
     */
    public function withRunID(string $runID): self
    {
        $obj = clone $this;
        $obj['runId'] = $runID;

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
}
