<?php

declare(strict_types=1);

namespace CaseDev\Vault\Groups;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Creates a vault group for organizing vaults and applying group-scoped access controls. Group-scoped API keys cannot create or manage vault groups.
 *
 * @see CaseDev\Services\Vault\GroupsService::create()
 *
 * @phpstan-type GroupCreateParamsShape = array{
 *   name: string, description?: string|null
 * }
 */
final class GroupCreateParams implements BaseModel
{
    /** @use SdkModel<GroupCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Human-readable name for the vault group.
     */
    #[Required]
    public string $name;

    /**
     * Optional description of the vault group purpose.
     */
    #[Optional]
    public ?string $description;

    /**
     * `new GroupCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GroupCreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GroupCreateParams)->withName(...)
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
     */
    public static function with(string $name, ?string $description = null): self
    {
        $self = new self;

        $self['name'] = $name;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * Human-readable name for the vault group.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Optional description of the vault group purpose.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
