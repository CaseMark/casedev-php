<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Agents;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Lists all active agents for the authenticated organization.
 *
 * @see CaseDev\Services\Agent\V1\AgentsService::list()
 *
 * @phpstan-type AgentListParamsShape = array{
 *   cursor?: string|null, limit?: int|null
 * }
 */
final class AgentListParams implements BaseModel
{
    /** @use SdkModel<AgentListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Pagination cursor (agent ID from previous page). Returns agents created before this agent.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Maximum number of agents to return (default 50, max 250).
     */
    #[Optional]
    public ?int $limit;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $cursor = null, ?int $limit = null): self
    {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Pagination cursor (agent ID from previous page). Returns agents created before this agent.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Maximum number of agents to return (default 50, max 250).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
