<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Invoke\InvokeRunResponse;

use Casedev\Compute\V1\Invoke\InvokeRunResponse\AsynchronousResponse\Status;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type AsynchronousResponseShape = array{
 *   logsURL?: string|null, runID?: string|null, status?: value-of<Status>|null
 * }
 */
final class AsynchronousResponse implements BaseModel
{
    /** @use SdkModel<AsynchronousResponseShape> */
    use SdkModel;

    /**
     * URL to check run status and logs.
     */
    #[Optional('logsUrl')]
    public ?string $logsURL;

    /**
     * Unique run identifier.
     */
    #[Optional('runId')]
    public ?string $runID;

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
        ?string $logsURL = null,
        ?string $runID = null,
        Status|string|null $status = null
    ): self {
        $self = new self;

        null !== $logsURL && $self['logsURL'] = $logsURL;
        null !== $runID && $self['runID'] = $runID;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * URL to check run status and logs.
     */
    public function withLogsURL(string $logsURL): self
    {
        $self = clone $this;
        $self['logsURL'] = $logsURL;

        return $self;
    }

    /**
     * Unique run identifier.
     */
    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

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
}
