<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\VaultDeleteResponse\DeletedVault;

/**
 * @phpstan-import-type DeletedVaultShape from \Casedev\Vault\VaultDeleteResponse\DeletedVault
 *
 * @phpstan-type VaultDeleteResponseShape = array{
 *   deletedVault?: null|DeletedVault|DeletedVaultShape,
 *   status?: string|null,
 *   success?: bool|null,
 * }
 */
final class VaultDeleteResponse implements BaseModel
{
    /** @use SdkModel<VaultDeleteResponseShape> */
    use SdkModel;

    #[Optional]
    public ?DeletedVault $deletedVault;

    /**
     * Either 'deleted' or 'deletion_queued'.
     */
    #[Optional]
    public ?string $status;

    #[Optional]
    public ?bool $success;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param DeletedVault|DeletedVaultShape|null $deletedVault
     */
    public static function with(
        DeletedVault|array|null $deletedVault = null,
        ?string $status = null,
        ?bool $success = null,
    ): self {
        $self = new self;

        null !== $deletedVault && $self['deletedVault'] = $deletedVault;
        null !== $status && $self['status'] = $status;
        null !== $success && $self['success'] = $success;

        return $self;
    }

    /**
     * @param DeletedVault|DeletedVaultShape $deletedVault
     */
    public function withDeletedVault(DeletedVault|array $deletedVault): self
    {
        $self = clone $this;
        $self['deletedVault'] = $deletedVault;

        return $self;
    }

    /**
     * Either 'deleted' or 'deletion_queued'.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
