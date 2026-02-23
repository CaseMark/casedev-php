<?php

declare(strict_types=1);

namespace Router\Agent\V1\Agents;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Updates an agent definition. Only provided fields are changed.
 *
 * @see Router\Services\Agent\V1\AgentsService::update()
 *
 * @phpstan-type AgentUpdateParamsShape = array{
 *   description?: string|null,
 *   disabledTools?: list<string>|null,
 *   enabledTools?: list<string>|null,
 *   instructions?: string|null,
 *   model?: string|null,
 *   name?: string|null,
 *   sandbox?: mixed,
 *   vaultIDs?: list<string>|null,
 * }
 */
final class AgentUpdateParams implements BaseModel
{
    /** @use SdkModel<AgentUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $description;

    /** @var list<string>|null $disabledTools */
    #[Optional(list: 'string', nullable: true)]
    public ?array $disabledTools;

    /** @var list<string>|null $enabledTools */
    #[Optional(list: 'string', nullable: true)]
    public ?array $enabledTools;

    #[Optional]
    public ?string $instructions;

    #[Optional]
    public ?string $model;

    #[Optional]
    public ?string $name;

    #[Optional(nullable: true)]
    public mixed $sandbox;

    /** @var list<string>|null $vaultIDs */
    #[Optional('vaultIds', list: 'string', nullable: true)]
    public ?array $vaultIDs;

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
     * @param list<string>|null $vaultIDs
     */
    public static function with(
        ?string $description = null,
        ?array $disabledTools = null,
        ?array $enabledTools = null,
        ?string $instructions = null,
        ?string $model = null,
        ?string $name = null,
        mixed $sandbox = null,
        ?array $vaultIDs = null,
    ): self {
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $disabledTools && $self['disabledTools'] = $disabledTools;
        null !== $enabledTools && $self['enabledTools'] = $enabledTools;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $model && $self['model'] = $model;
        null !== $name && $self['name'] = $name;
        null !== $sandbox && $self['sandbox'] = $sandbox;
        null !== $vaultIDs && $self['vaultIDs'] = $vaultIDs;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

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

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withSandbox(mixed $sandbox): self
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
