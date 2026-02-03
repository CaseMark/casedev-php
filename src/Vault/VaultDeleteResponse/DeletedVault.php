<?php

declare(strict_types=1);

namespace Casedev\Vault\VaultDeleteResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type DeletedVaultShape = array{
 *   id?: string|null,
 *   bytesFreed?: int|null,
 *   name?: string|null,
 *   objectsDeleted?: int|null,
 *   vectorsDeleted?: int|null,
 * }
 */
final class DeletedVault implements BaseModel
{
    /** @use SdkModel<DeletedVaultShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?int $bytesFreed;

    #[Optional]
    public ?string $name;

    #[Optional]
    public ?int $objectsDeleted;

    #[Optional]
    public ?int $vectorsDeleted;

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
        ?string $id = null,
        ?int $bytesFreed = null,
        ?string $name = null,
        ?int $objectsDeleted = null,
        ?int $vectorsDeleted = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $bytesFreed && $self['bytesFreed'] = $bytesFreed;
        null !== $name && $self['name'] = $name;
        null !== $objectsDeleted && $self['objectsDeleted'] = $objectsDeleted;
        null !== $vectorsDeleted && $self['vectorsDeleted'] = $vectorsDeleted;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withBytesFreed(int $bytesFreed): self
    {
        $self = clone $this;
        $self['bytesFreed'] = $bytesFreed;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withObjectsDeleted(int $objectsDeleted): self
    {
        $self = clone $this;
        $self['objectsDeleted'] = $objectsDeleted;

        return $self;
    }

    public function withVectorsDeleted(int $vectorsDeleted): self
    {
        $self = clone $this;
        $self['vectorsDeleted'] = $vectorsDeleted;

        return $self;
    }
}
