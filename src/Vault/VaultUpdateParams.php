<?php

declare(strict_types=1);

namespace Router\Vault;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Update vault settings including name, description, and enableGraph. Changing enableGraph only affects future document uploads - existing documents retain their current graph/non-graph state.
 *
 * @see Router\Services\VaultService::update()
 *
 * @phpstan-type VaultUpdateParamsShape = array{
 *   description?: string|null,
 *   enableGraph?: bool|null,
 *   groupID?: string|null,
 *   name?: string|null,
 * }
 */
final class VaultUpdateParams implements BaseModel
{
    /** @use SdkModel<VaultUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * New description for the vault. Set to null to remove.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Whether to enable GraphRAG for future document uploads.
     */
    #[Optional]
    public ?bool $enableGraph;

    /**
     * Move the vault to a different group, or set to null to remove from its current group.
     */
    #[Optional('groupId', nullable: true)]
    public ?string $groupID;

    /**
     * New name for the vault.
     */
    #[Optional]
    public ?string $name;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $description = null,
        ?bool $enableGraph = null,
        ?string $groupID = null,
        ?string $name = null,
    ): self {
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $enableGraph && $self['enableGraph'] = $enableGraph;
        null !== $groupID && $self['groupID'] = $groupID;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * New description for the vault. Set to null to remove.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Whether to enable GraphRAG for future document uploads.
     */
    public function withEnableGraph(bool $enableGraph): self
    {
        $self = clone $this;
        $self['enableGraph'] = $enableGraph;

        return $self;
    }

    /**
     * Move the vault to a different group, or set to null to remove from its current group.
     */
    public function withGroupID(?string $groupID): self
    {
        $self = clone $this;
        $self['groupID'] = $groupID;

        return $self;
    }

    /**
     * New name for the vault.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
