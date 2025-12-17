<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\VaultListResponse\Vault;

/**
 * @phpstan-import-type VaultShape from \Casedev\Vault\VaultListResponse\Vault
 *
 * @phpstan-type VaultListResponseShape = array{
 *   total?: int|null, vaults?: list<VaultShape>|null
 * }
 */
final class VaultListResponse implements BaseModel
{
    /** @use SdkModel<VaultListResponseShape> */
    use SdkModel;

    /**
     * Total number of vaults.
     */
    #[Optional]
    public ?int $total;

    /** @var list<Vault>|null $vaults */
    #[Optional(list: Vault::class)]
    public ?array $vaults;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<VaultShape> $vaults
     */
    public static function with(?int $total = null, ?array $vaults = null): self
    {
        $self = new self;

        null !== $total && $self['total'] = $total;
        null !== $vaults && $self['vaults'] = $vaults;

        return $self;
    }

    /**
     * Total number of vaults.
     */
    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }

    /**
     * @param list<VaultShape> $vaults
     */
    public function withVaults(array $vaults): self
    {
        $self = clone $this;
        $self['vaults'] = $vaults;

        return $self;
    }
}
