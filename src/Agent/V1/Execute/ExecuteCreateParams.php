<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Execute;

use CaseDev\Agent\V1\Execute\ExecuteCreateParams\Sandbox;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Creates an ephemeral agent and immediately executes a run. Returns the run ID for polling status and results. This is the fastest way to run an agent without managing agent lifecycle.
 *
 * @see CaseDev\Services\Agent\V1\ExecuteService::create()
 *
 * @phpstan-import-type SandboxShape from \CaseDev\Agent\V1\Execute\ExecuteCreateParams\Sandbox
 *
 * @phpstan-type ExecuteCreateParamsShape = array{
 *   prompt: string,
 *   disabledTools?: list<string>|null,
 *   enabledTools?: list<string>|null,
 *   guidance?: string|null,
 *   instructions?: string|null,
 *   model?: string|null,
 *   objectIDs?: list<string>|null,
 *   sandbox?: null|Sandbox|SandboxShape,
 *   vaultIDs?: list<string>|null,
 * }
 */
final class ExecuteCreateParams implements BaseModel
{
    /** @use SdkModel<ExecuteCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Task prompt for the agent.
     */
    #[Required]
    public string $prompt;

    /**
     * Denylist of tools the agent cannot use.
     *
     * @var list<string>|null $disabledTools
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $disabledTools;

    /**
     * Allowlist of tools the agent can use.
     *
     * @var list<string>|null $enabledTools
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $enabledTools;

    /**
     * Additional context or constraints for this run.
     */
    #[Optional(nullable: true)]
    public ?string $guidance;

    /**
     * System instructions. Defaults to a general-purpose legal assistant prompt if not provided.
     */
    #[Optional]
    public ?string $instructions;

    /**
     * LLM model identifier. Defaults to anthropic/claude-sonnet-4.6.
     */
    #[Optional]
    public ?string $model;

    /**
     * Scope this run to specific vault object IDs. The agent will only access these objects.
     *
     * @var list<string>|null $objectIDs
     */
    #[Optional('objectIds', list: 'string', nullable: true)]
    public ?array $objectIDs;

    /**
     * Custom sandbox resources (cpu, memoryMiB).
     */
    #[Optional(nullable: true)]
    public ?Sandbox $sandbox;

    /**
     * Restrict agent to specific vault IDs.
     *
     * @var list<string>|null $vaultIDs
     */
    #[Optional('vaultIds', list: 'string', nullable: true)]
    public ?array $vaultIDs;

    /**
     * `new ExecuteCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExecuteCreateParams::with(prompt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExecuteCreateParams)->withPrompt(...)
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
     * @param list<string>|null $disabledTools
     * @param list<string>|null $enabledTools
     * @param list<string>|null $objectIDs
     * @param Sandbox|SandboxShape|null $sandbox
     * @param list<string>|null $vaultIDs
     */
    public static function with(
        string $prompt,
        ?array $disabledTools = null,
        ?array $enabledTools = null,
        ?string $guidance = null,
        ?string $instructions = null,
        ?string $model = null,
        ?array $objectIDs = null,
        Sandbox|array|null $sandbox = null,
        ?array $vaultIDs = null,
    ): self {
        $self = new self;

        $self['prompt'] = $prompt;

        null !== $disabledTools && $self['disabledTools'] = $disabledTools;
        null !== $enabledTools && $self['enabledTools'] = $enabledTools;
        null !== $guidance && $self['guidance'] = $guidance;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $model && $self['model'] = $model;
        null !== $objectIDs && $self['objectIDs'] = $objectIDs;
        null !== $sandbox && $self['sandbox'] = $sandbox;
        null !== $vaultIDs && $self['vaultIDs'] = $vaultIDs;

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
     * Denylist of tools the agent cannot use.
     *
     * @param list<string>|null $disabledTools
     */
    public function withDisabledTools(?array $disabledTools): self
    {
        $self = clone $this;
        $self['disabledTools'] = $disabledTools;

        return $self;
    }

    /**
     * Allowlist of tools the agent can use.
     *
     * @param list<string>|null $enabledTools
     */
    public function withEnabledTools(?array $enabledTools): self
    {
        $self = clone $this;
        $self['enabledTools'] = $enabledTools;

        return $self;
    }

    /**
     * Additional context or constraints for this run.
     */
    public function withGuidance(?string $guidance): self
    {
        $self = clone $this;
        $self['guidance'] = $guidance;

        return $self;
    }

    /**
     * System instructions. Defaults to a general-purpose legal assistant prompt if not provided.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * LLM model identifier. Defaults to anthropic/claude-sonnet-4.6.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Scope this run to specific vault object IDs. The agent will only access these objects.
     *
     * @param list<string>|null $objectIDs
     */
    public function withObjectIDs(?array $objectIDs): self
    {
        $self = clone $this;
        $self['objectIDs'] = $objectIDs;

        return $self;
    }

    /**
     * Custom sandbox resources (cpu, memoryMiB).
     *
     * @param Sandbox|SandboxShape|null $sandbox
     */
    public function withSandbox(Sandbox|array|null $sandbox): self
    {
        $self = clone $this;
        $self['sandbox'] = $sandbox;

        return $self;
    }

    /**
     * Restrict agent to specific vault IDs.
     *
     * @param list<string>|null $vaultIDs
     */
    public function withVaultIDs(?array $vaultIDs): self
    {
        $self = clone $this;
        $self['vaultIDs'] = $vaultIDs;

        return $self;
    }
}
