<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run;

use CaseDev\Agent\V1\Run\RunListParams\Status;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Lists agent runs for the authenticated organization. Supports filtering by agent, status, and cursor-based pagination.
 *
 * @see CaseDev\Services\Agent\V1\RunService::list()
 *
 * @phpstan-type RunListParamsShape = array{
 *   agentID?: string|null,
 *   cursor?: string|null,
 *   limit?: int|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class RunListParams implements BaseModel
{
    /** @use SdkModel<RunListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by agent ID.
     */
    #[Optional]
    public ?string $agentID;

    /**
     * Pagination cursor (run ID from previous page). Returns runs created before this run.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Maximum number of runs to return (default 50, max 250).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter by run status.
     *
     * @var value-of<Status>|null $status
     */
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
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $agentID = null,
        ?string $cursor = null,
        ?int $limit = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $agentID && $self['agentID'] = $agentID;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Filter by agent ID.
     */
    public function withAgentID(string $agentID): self
    {
        $self = clone $this;
        $self['agentID'] = $agentID;

        return $self;
    }

    /**
     * Pagination cursor (run ID from previous page). Returns runs created before this run.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Maximum number of runs to return (default 50, max 250).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter by run status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
