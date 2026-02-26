<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Creates a run in queued state. Call POST /agent/v1/run/:id/exec to start execution.
 *
 * @see CaseDev\Services\Agent\V1\RunService::create()
 *
 * @phpstan-type RunCreateParamsShape = array{
 *   agentID: string,
 *   prompt: string,
 *   guidance?: string|null,
 *   model?: string|null,
 *   objectIDs?: list<string>|null,
 * }
 */
final class RunCreateParams implements BaseModel
{
    /** @use SdkModel<RunCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * ID of the agent to run.
     */
    #[Required('agentId')]
    public string $agentID;

    /**
     * Task prompt for the agent.
     */
    #[Required]
    public string $prompt;

    /**
     * Additional guidance for this run.
     */
    #[Optional(nullable: true)]
    public ?string $guidance;

    /**
     * Override the agent default model for this run.
     */
    #[Optional(nullable: true)]
    public ?string $model;

    /**
     * Scope this run to specific vault object IDs. The agent will only be able to access these objects during execution.
     *
     * @var list<string>|null $objectIDs
     */
    #[Optional('objectIds', list: 'string', nullable: true)]
    public ?array $objectIDs;

    /**
     * `new RunCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RunCreateParams::with(agentID: ..., prompt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RunCreateParams)->withAgentID(...)->withPrompt(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $objectIDs
     */
    public static function with(
        string $agentID,
        string $prompt,
        ?string $guidance = null,
        ?string $model = null,
        ?array $objectIDs = null,
    ): self {
        $self = new self;

        $self['agentID'] = $agentID;
        $self['prompt'] = $prompt;

        null !== $guidance && $self['guidance'] = $guidance;
        null !== $model && $self['model'] = $model;
        null !== $objectIDs && $self['objectIDs'] = $objectIDs;

        return $self;
    }

    /**
     * ID of the agent to run.
     */
    public function withAgentID(string $agentID): self
    {
        $self = clone $this;
        $self['agentID'] = $agentID;

        return $self;
    }

    /**
     * Task prompt for the agent.
     */
    public function withPrompt(string $prompt): self
    {
        $self = clone $this;
        $self['prompt'] = $prompt;

        return $self;
    }

    /**
     * Additional guidance for this run.
     */
    public function withGuidance(?string $guidance): self
    {
        $self = clone $this;
        $self['guidance'] = $guidance;

        return $self;
    }

    /**
     * Override the agent default model for this run.
     */
    public function withModel(?string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Scope this run to specific vault object IDs. The agent will only be able to access these objects during execution.
     *
     * @param list<string>|null $objectIDs
     */
    public function withObjectIDs(?array $objectIDs): self
    {
        $self = clone $this;
        $self['objectIDs'] = $objectIDs;

        return $self;
    }
}
