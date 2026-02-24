<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Agents;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type AgentUpdateResponseShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   description?: string|null,
 *   disabledTools?: list<string>|null,
 *   enabledTools?: list<string>|null,
 *   instructions?: string|null,
 *   isActive?: bool|null,
 *   model?: string|null,
 *   name?: string|null,
 *   sandbox?: mixed,
 *   updatedAt?: \DateTimeInterface|null,
 *   vaultIDs?: list<string>|null,
 * }
 */
final class AgentUpdateResponse implements BaseModel
{
    /** @use SdkModel<AgentUpdateResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?\DateTimeInterface $createdAt;

    #[Optional(nullable: true)]
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
    public ?bool $isActive;

    #[Optional]
    public ?string $model;

    #[Optional]
    public ?string $name;

    #[Optional(nullable: true)]
    public mixed $sandbox;

    #[Optional]
    public ?\DateTimeInterface $updatedAt;

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
        ?string $id = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $description = null,
        ?array $disabledTools = null,
        ?array $enabledTools = null,
        ?string $instructions = null,
        ?bool $isActive = null,
        ?string $model = null,
        ?string $name = null,
        mixed $sandbox = null,
        ?\DateTimeInterface $updatedAt = null,
        ?array $vaultIDs = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $description && $self['description'] = $description;
        null !== $disabledTools && $self['disabledTools'] = $disabledTools;
        null !== $enabledTools && $self['enabledTools'] = $enabledTools;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $isActive && $self['isActive'] = $isActive;
        null !== $model && $self['model'] = $model;
        null !== $name && $self['name'] = $name;
        null !== $sandbox && $self['sandbox'] = $sandbox;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;
        null !== $vaultIDs && $self['vaultIDs'] = $vaultIDs;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withDescription(?string $description): self
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

    public function withIsActive(bool $isActive): self
    {
        $self = clone $this;
        $self['isActive'] = $isActive;

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

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

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
