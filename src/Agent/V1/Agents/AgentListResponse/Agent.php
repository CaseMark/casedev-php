<?php

declare(strict_types=1);

namespace Router\Agent\V1\Agents\AgentListResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type AgentShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   description?: string|null,
 *   isActive?: bool|null,
 *   model?: string|null,
 *   name?: string|null,
 *   updatedAt?: \DateTimeInterface|null,
 *   vaultIDs?: list<string>|null,
 * }
 */
final class Agent implements BaseModel
{
    /** @use SdkModel<AgentShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?\DateTimeInterface $createdAt;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional]
    public ?bool $isActive;

    #[Optional]
    public ?string $model;

    #[Optional]
    public ?string $name;

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
     * @param list<string>|null $vaultIDs
     */
    public static function with(
        ?string $id = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $description = null,
        ?bool $isActive = null,
        ?string $model = null,
        ?string $name = null,
        ?\DateTimeInterface $updatedAt = null,
        ?array $vaultIDs = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $description && $self['description'] = $description;
        null !== $isActive && $self['isActive'] = $isActive;
        null !== $model && $self['model'] = $model;
        null !== $name && $self['name'] = $name;
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
