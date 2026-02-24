<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\Objects\ObjectListResponse\Object_;

/**
 * @phpstan-import-type ObjectShape from \CaseDev\Vault\Objects\ObjectListResponse\Object_
 *
 * @phpstan-type ObjectListResponseShape = array{
 *   count: float, objects: list<Object_|ObjectShape>, vaultID: string
 * }
 */
final class ObjectListResponse implements BaseModel
{
    /** @use SdkModel<ObjectListResponseShape> */
    use SdkModel;

    /**
     * Total number of objects in the vault.
     */
    #[Required]
    public float $count;

    /** @var list<Object_> $objects */
    #[Required(list: Object_::class)]
    public array $objects;

    /**
     * The ID of the vault.
     */
    #[Required('vaultId')]
    public string $vaultID;

    /**
     * `new ObjectListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ObjectListResponse::with(count: ..., objects: ..., vaultID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ObjectListResponse)->withCount(...)->withObjects(...)->withVaultID(...)
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
     *
     * @param list<Object_|ObjectShape> $objects
     */
    public static function with(
        float $count,
        array $objects,
        string $vaultID
    ): self {
        $self = new self;

        $self['count'] = $count;
        $self['objects'] = $objects;
        $self['vaultID'] = $vaultID;

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
