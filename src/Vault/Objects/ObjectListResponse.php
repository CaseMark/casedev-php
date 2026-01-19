<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\Objects\ObjectListResponse\Object_;

/**
 * @phpstan-import-type ObjectShape from \Casedev\Vault\Objects\ObjectListResponse\Object_
 *
 * @phpstan-type ObjectListResponseShape = array{
 *   count?: float|null,
 *   objects?: list<Object_|ObjectShape>|null,
 *   vaultID?: string|null,
 * }
 */
final class ObjectListResponse implements BaseModel
{
    /** @use SdkModel<ObjectListResponseShape> */
    use SdkModel;

    /**
     * Total number of objects in the vault.
     */
    #[Optional]
    public ?float $count;

    /** @var list<Object_>|null $objects */
    #[Optional(list: Object_::class)]
    public ?array $objects;

    /**
     * The ID of the vault.
     */
    #[Optional('vaultId')]
    public ?string $vaultID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Object_|ObjectShape>|null $objects
     */
    public static function with(
        ?float $count = null,
        ?array $objects = null,
        ?string $vaultID = null
    ): self {
        $self = new self;

        null !== $count && $self['count'] = $count;
        null !== $objects && $self['objects'] = $objects;
        null !== $vaultID && $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * Total number of objects in the vault.
     */
    public function withCount(float $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    /**
     * @param list<Object_|ObjectShape> $objects
     */
    public function withObjects(array $objects): self
    {
        $self = clone $this;
        $self['objects'] = $objects;

        return $self;
    }

    /**
     * The ID of the vault.
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }
}
