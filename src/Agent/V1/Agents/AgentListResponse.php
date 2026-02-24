<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Agents;

use CaseDev\Agent\V1\Agents\AgentListResponse\Agent;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AgentShape from \CaseDev\Agent\V1\Agents\AgentListResponse\Agent
 *
 * @phpstan-type AgentListResponseShape = array{
 *   agents?: list<Agent|AgentShape>|null
 * }
 */
final class AgentListResponse implements BaseModel
{
    /** @use SdkModel<AgentListResponseShape> */
    use SdkModel;

    /** @var list<Agent>|null $agents */
    #[Optional(list: Agent::class)]
    public ?array $agents;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Agent|AgentShape>|null $agents
     */
    public static function with(?array $agents = null): self
    {
        $self = new self;

        null !== $agents && $self['agents'] = $agents;

        return $self;
    }

    /**
     * @param list<Agent|AgentShape> $agents
     */
    public function withAgents(array $agents): self
    {
        $self = clone $this;
        $self['agents'] = $agents;

        return $self;
    }
}
