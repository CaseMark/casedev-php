<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Run;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Creates a v2 run in queued state. Call POST /agent/v2/run/:id/exec to start execution on the Daytona runtime.
 *
 * @see CaseDev\Services\Agent\V2\RunService::create()
 *
 * @phpstan-type RunCreateParamsShape = array{
 *   agentID: string,
 *   prompt: string,
 *   callbackURL?: string|null,
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

    #[Required('agentId')]
    public string $agentID;

    #[Required]
    public string $prompt;

    #[Optional('callbackUrl', nullable: true)]
    public ?string $callbackURL;

    #[Optional(nullable: true)]
    public ?string $guidance;

    #[Optional(nullable: true)]
    public ?string $model;

    /** @var list<string>|null $objectIDs */
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
        ?string $callbackURL = null,
        ?string $guidance = null,
        ?string $model = null,
        ?array $objectIDs = null,
    ): self {
        $self = new self;

        $self['agentID'] = $agentID;
        $self['prompt'] = $prompt;

        null !== $callbackURL && $self['callbackURL'] = $callbackURL;
        null !== $guidance && $self['guidance'] = $guidance;
        null !== $model && $self['model'] = $model;
        null !== $objectIDs && $self['objectIDs'] = $objectIDs;

        return $self;
    }

    public function withAgentID(string $agentID): self
    {
        $self = clone $this;
        $self['agentID'] = $agentID;

        return $self;
    }

    public function withPrompt(string $prompt): self
    {
        $self = clone $this;
        $self['prompt'] = $prompt;

        return $self;
    }

    public function withCallbackURL(?string $callbackURL): self
    {
        $self = clone $this;
        $self['callbackURL'] = $callbackURL;

        return $self;
    }

    public function withGuidance(?string $guidance): self
    {
        $self = clone $this;
        $self['guidance'] = $guidance;

        return $self;
    }

    public function withModel(?string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * @param list<string>|null $objectIDs
     */
    public function withObjectIDs(?array $objectIDs): self
    {
        $self = clone $this;
        $self['objectIDs'] = $objectIDs;

        return $self;
    }
}
