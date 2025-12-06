<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;
use Casedev\Vault\VaultListResponse\Vault;

/**
 * @phpstan-type VaultListResponseShape = array{
 *   total?: int|null, vaults?: list<Vault>|null
 * }
 */
final class VaultListResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<VaultListResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Total number of vaults.
     */
    #[Api(optional: true)]
    public ?int $total;

    /** @var list<Vault>|null $vaults */
    #[Api(list: Vault::class, optional: true)]
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
     * @param list<Vault|array{
     *   id?: string|null,
     *   createdAt?: \DateTimeInterface|null,
     *   description?: string|null,
     *   enableGraph?: bool|null,
     *   name?: string|null,
     *   totalBytes?: int|null,
     *   totalObjects?: int|null,
     * }> $vaults
     */
    public static function with(?int $total = null, ?array $vaults = null): self
    {
        $obj = new self;

        null !== $total && $obj['total'] = $total;
        null !== $vaults && $obj['vaults'] = $vaults;

        return $obj;
    }

    /**
     * Total number of vaults.
     */
    public function withTotal(int $total): self
    {
        $obj = clone $this;
        $obj['total'] = $total;

        return $obj;
    }

    /**
     * @param list<Vault|array{
     *   id?: string|null,
     *   createdAt?: \DateTimeInterface|null,
     *   description?: string|null,
     *   enableGraph?: bool|null,
     *   name?: string|null,
     *   totalBytes?: int|null,
     *   totalObjects?: int|null,
     * }> $vaults
     */
    public function withVaults(array $vaults): self
    {
        $obj = clone $this;
        $obj['vaults'] = $vaults;

        return $obj;
    }
}
