<?php

declare(strict_types=1);

namespace CaseDev\Webhooks\V1\Endpoints\EndpointUpdateParams;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResourceScopesShape = array{
 *   matterIDs?: list<string>|null, vaultIDs?: list<string>|null
 * }
 */
final class ResourceScopes implements BaseModel
{
    /** @use SdkModel<ResourceScopesShape> */
    use SdkModel;

    /** @var list<string>|null $matterIDs */
    #[Optional('matterIds', list: 'string')]
    public ?array $matterIDs;

    /** @var list<string>|null $vaultIDs */
    #[Optional('vaultIds', list: 'string')]
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
     * @param list<string>|null $matterIDs
     * @param list<string>|null $vaultIDs
     */
    public static function with(
        ?array $matterIDs = null,
        ?array $vaultIDs = null
    ): self {
        $self = new self;

        null !== $matterIDs && $self['matterIDs'] = $matterIDs;
        null !== $vaultIDs && $self['vaultIDs'] = $vaultIDs;

        return $self;
    }

    /**
     * @param list<string> $matterIDs
     */
    public function withMatterIDs(array $matterIDs): self
    {
        $self = clone $this;
        $self['matterIDs'] = $matterIDs;

        return $self;
    }

    /**
     * @param list<string> $vaultIDs
     */
    public function withVaultIDs(array $vaultIDs): self
    {
        $self = clone $this;
        $self['vaultIDs'] = $vaultIDs;

        return $self;
    }
}
