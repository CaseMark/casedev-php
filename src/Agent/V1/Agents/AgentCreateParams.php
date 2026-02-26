<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Agents;

use CaseDev\Agent\V1\Agents\AgentCreateParams\Sandbox;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Creates a new agent definition with a scoped API key. The agent can then be used to create and execute runs.
 *
 * @see CaseDev\Services\Agent\V1\AgentsService::create()
 *
 * @phpstan-import-type SandboxShape from \CaseDev\Agent\V1\Agents\AgentCreateParams\Sandbox
 *
 * @phpstan-type AgentCreateParamsShape = array{
 *   instructions: string,
 *   name: string,
 *   description?: string|null,
 *   disabledTools?: list<string>|null,
 *   enabledTools?: list<string>|null,
 *   model?: string|null,
 *   sandbox?: null|Sandbox|SandboxShape,
 *   vaultGroups?: list<string>|null,
 *   vaultIDs?: list<string>|null,
 * }
 */
final class AgentCreateParams implements BaseModel
{
    /** @use SdkModel<AgentCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * System instructions that define agent behavior.
     */
    #[Required]
    public string $instructions;

    /**
     * Display name for the agent.
     */
    #[Required]
    public string $name;

    /**
     * Optional description of the agent.
     */
    #[Optional]
    public ?string $description;

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
     * LLM model identifier (e.g. anthropic/claude-sonnet-4.6). Defaults to anthropic/claude-sonnet-4.6.
     */
    #[Optional]
    public ?string $model;

    /**
     * Custom sandbox configuration (cpu, memoryMiB).
     */
    #[Optional(nullable: true)]
    public ?Sandbox $sandbox;

    /**
     * Restrict agent to vaults within specific vault group IDs.
     *
     * @var list<string>|null $vaultGroups
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $vaultGroups;

    /**
     * Restrict agent to specific vault IDs.
     *
     * @var list<string>|null $vaultIDs
     */
    #[Optional('vaultIds', list: 'string', nullable: true)]
    public ?array $vaultIDs;

    /**
     * `new AgentCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AgentCreateParams::with(instructions: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AgentCreateParams)->withInstructions(...)->withName(...)
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
     * @param Sandbox|SandboxShape|null $sandbox
     * @param list<string>|null $vaultGroups
     * @param list<string>|null $vaultIDs
     */
    public static function with(
        string $instructions,
        string $name,
        ?string $description = null,
        ?array $disabledTools = null,
        ?array $enabledTools = null,
        ?string $model = null,
        Sandbox|array|null $sandbox = null,
        ?array $vaultGroups = null,
        ?array $vaultIDs = null,
    ): self {
        $self = new self;

        $self['instructions'] = $instructions;
        $self['name'] = $name;

        null !== $description && $self['description'] = $description;
        null !== $disabledTools && $self['disabledTools'] = $disabledTools;
        null !== $enabledTools && $self['enabledTools'] = $enabledTools;
        null !== $model && $self['model'] = $model;
        null !== $sandbox && $self['sandbox'] = $sandbox;
        null !== $vaultGroups && $self['vaultGroups'] = $vaultGroups;
        null !== $vaultIDs && $self['vaultIDs'] = $vaultIDs;

        return $self;
    }

    /**
     * System instructions that define agent behavior.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * Display name for the agent.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Optional description of the agent.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

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
     * LLM model identifier (e.g. anthropic/claude-sonnet-4.6). Defaults to anthropic/claude-sonnet-4.6.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Custom sandbox configuration (cpu, memoryMiB).
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
     * Restrict agent to vaults within specific vault group IDs.
     *
     * @param list<string>|null $vaultGroups
     */
    public function withVaultGroups(?array $vaultGroups): self
    {
        $self = clone $this;
        $self['vaultGroups'] = $vaultGroups;

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
