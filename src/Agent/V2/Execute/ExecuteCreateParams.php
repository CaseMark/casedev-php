<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Execute;

use CaseDev\Agent\V2\Execute\ExecuteCreateParams\Sandbox;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Creates an ephemeral agent and executes it immediately. By default this uses the lightweight synchronous linc runtime on Vercel Sandbox. Set `agentRuntime: true` to opt into the legacy Daytona-backed agent runtime.
 *
 * @see CaseDev\Services\Agent\V2\ExecuteService::create()
 *
 * @phpstan-import-type SandboxShape from \CaseDev\Agent\V2\Execute\ExecuteCreateParams\Sandbox
 *
 * @phpstan-type ExecuteCreateParamsShape = array{
 *   prompt: string,
 *   agentRuntime?: bool|null,
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

    #[Required]
    public string $prompt;

    /**
     * Set to true to opt into the legacy Daytona-backed agent runtime.
     */
    #[Optional(nullable: true)]
    public ?bool $agentRuntime;

    /** @var list<string>|null $disabledTools */
    #[Optional(list: 'string', nullable: true)]
    public ?array $disabledTools;

    /** @var list<string>|null $enabledTools */
    #[Optional(list: 'string', nullable: true)]
    public ?array $enabledTools;

    #[Optional(nullable: true)]
    public ?string $guidance;

    #[Optional]
    public ?string $instructions;

    #[Optional]
    public ?string $model;

    /** @var list<string>|null $objectIDs */
    #[Optional('objectIds', list: 'string', nullable: true)]
    public ?array $objectIDs;

    #[Optional(nullable: true)]
    public ?Sandbox $sandbox;

    /** @var list<string>|null $vaultIDs */
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
        ?bool $agentRuntime = null,
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

        null !== $agentRuntime && $self['agentRuntime'] = $agentRuntime;
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

    public function withPrompt(string $prompt): self
    {
        $self = clone $this;
        $self['prompt'] = $prompt;

        return $self;
    }

    /**
     * Set to true to opt into the legacy Daytona-backed agent runtime.
     */
    public function withAgentRuntime(?bool $agentRuntime): self
    {
        $self = clone $this;
        $self['agentRuntime'] = $agentRuntime;

        return $self;
    }

    /**
     * @param list<string>|null $disabledTools
     */
    public function withDisabledTools(?array $disabledTools): self
    {
        $self = clone $this;
        $self['disabledTools'] = $disabledTools;

        return $self;
    }

    /**
     * @param list<string>|null $enabledTools
     */
    public function withEnabledTools(?array $enabledTools): self
    {
        $self = clone $this;
        $self['enabledTools'] = $enabledTools;

        return $self;
    }

    public function withGuidance(?string $guidance): self
    {
        $self = clone $this;
        $self['guidance'] = $guidance;

        return $self;
    }

    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    public function withModel(string $model): self
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

    /**
     * @param Sandbox|SandboxShape|null $sandbox
     */
    public function withSandbox(Sandbox|array|null $sandbox): self
    {
        $self = clone $this;
        $self['sandbox'] = $sandbox;

        return $self;
    }

    /**
     * @param list<string>|null $vaultIDs
     */
    public function withVaultIDs(?array $vaultIDs): self
    {
        $self = clone $this;
        $self['vaultIDs'] = $vaultIDs;

        return $self;
    }
}
