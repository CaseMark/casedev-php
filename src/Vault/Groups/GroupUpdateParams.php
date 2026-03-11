<?php

declare(strict_types=1);

namespace CaseDev\Vault\Groups;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Updates a vault group for the authenticated organization. Only provided fields are changed, and setting description to null removes the current description.
 *
 * @see CaseDev\Services\Vault\GroupsService::update()
 *
 * @phpstan-type GroupUpdateParamsShape = array{
 *   description?: string|null, name?: string|null
 * }
 */
final class GroupUpdateParams implements BaseModel
{
    /** @use SdkModel<GroupUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Updated vault group description. Pass null to remove the current description.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * New human-readable name for the vault group.
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
        ?string $name = null
    ): self {
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * Updated vault group description. Pass null to remove the current description.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * New human-readable name for the vault group.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
