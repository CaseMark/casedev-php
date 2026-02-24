<?php

declare(strict_types=1);

namespace CaseDev\Compute\V1\Instances;

use CaseDev\Compute\V1\Instances\InstanceGetResponse\SSH;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type SSHShape from \CaseDev\Compute\V1\Instances\InstanceGetResponse\SSH
 *
 * @phpstan-type InstanceGetResponseShape = array{
 *   id?: string|null,
 *   autoShutdownMinutes?: int|null,
 *   createdAt?: string|null,
 *   currentCost?: string|null,
 *   currentRuntimeSeconds?: int|null,
 *   gpu?: string|null,
 *   instanceType?: string|null,
 *   ip?: string|null,
 *   name?: string|null,
 *   pricePerHour?: string|null,
 *   region?: string|null,
 *   specs?: mixed,
 *   ssh?: null|SSH|SSHShape,
 *   startedAt?: string|null,
 *   status?: string|null,
 *   vaultMounts?: mixed,
 * }
 */
final class InstanceGetResponse implements BaseModel
{
    /** @use SdkModel<InstanceGetResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional(nullable: true)]
    public ?int $autoShutdownMinutes;

    #[Optional]
    public ?string $createdAt;

    #[Optional]
    public ?string $currentCost;

    #[Optional]
    public ?int $currentRuntimeSeconds;

    #[Optional]
    public ?string $gpu;

    #[Optional]
    public ?string $instanceType;

    #[Optional(nullable: true)]
    public ?string $ip;

    #[Optional]
    public ?string $name;

    #[Optional]
    public ?string $pricePerHour;

    #[Optional]
    public ?string $region;

    #[Optional]
    public mixed $specs;

    #[Optional(nullable: true)]
    public ?SSH $ssh;

    #[Optional(nullable: true)]
    public ?string $startedAt;

    #[Optional]
    public ?string $status;

    #[Optional(nullable: true)]
    public mixed $vaultMounts;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param SSH|SSHShape|null $ssh
     */
    public static function with(
        ?string $id = null,
        ?int $autoShutdownMinutes = null,
        ?string $createdAt = null,
        ?string $currentCost = null,
        ?int $currentRuntimeSeconds = null,
        ?string $gpu = null,
        ?string $instanceType = null,
        ?string $ip = null,
        ?string $name = null,
        ?string $pricePerHour = null,
        ?string $region = null,
        mixed $specs = null,
        SSH|array|null $ssh = null,
        ?string $startedAt = null,
        ?string $status = null,
        mixed $vaultMounts = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $autoShutdownMinutes && $self['autoShutdownMinutes'] = $autoShutdownMinutes;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $currentCost && $self['currentCost'] = $currentCost;
        null !== $currentRuntimeSeconds && $self['currentRuntimeSeconds'] = $currentRuntimeSeconds;
        null !== $gpu && $self['gpu'] = $gpu;
        null !== $instanceType && $self['instanceType'] = $instanceType;
        null !== $ip && $self['ip'] = $ip;
        null !== $name && $self['name'] = $name;
        null !== $pricePerHour && $self['pricePerHour'] = $pricePerHour;
        null !== $region && $self['region'] = $region;
        null !== $specs && $self['specs'] = $specs;
        null !== $ssh && $self['ssh'] = $ssh;
        null !== $startedAt && $self['startedAt'] = $startedAt;
        null !== $status && $self['status'] = $status;
        null !== $vaultMounts && $self['vaultMounts'] = $vaultMounts;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withAutoShutdownMinutes(?int $autoShutdownMinutes): self
    {
        $self = clone $this;
        $self['autoShutdownMinutes'] = $autoShutdownMinutes;

        return $self;
    }

    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withCurrentCost(string $currentCost): self
    {
        $self = clone $this;
        $self['currentCost'] = $currentCost;

        return $self;
    }

    public function withCurrentRuntimeSeconds(int $currentRuntimeSeconds): self
    {
        $self = clone $this;
        $self['currentRuntimeSeconds'] = $currentRuntimeSeconds;

        return $self;
    }

    public function withGPU(string $gpu): self
    {
        $self = clone $this;
        $self['gpu'] = $gpu;

        return $self;
    }

    public function withInstanceType(string $instanceType): self
    {
        $self = clone $this;
        $self['instanceType'] = $instanceType;

        return $self;
    }

    public function withIP(?string $ip): self
    {
        $self = clone $this;
        $self['ip'] = $ip;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withPricePerHour(string $pricePerHour): self
    {
        $self = clone $this;
        $self['pricePerHour'] = $pricePerHour;

        return $self;
    }

    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    public function withSpecs(mixed $specs): self
    {
        $self = clone $this;
        $self['specs'] = $specs;

        return $self;
    }

    /**
     * @param SSH|SSHShape|null $ssh
     */
    public function withSSH(SSH|array|null $ssh): self
    {
        $self = clone $this;
        $self['ssh'] = $ssh;

        return $self;
    }

    public function withStartedAt(?string $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withVaultMounts(mixed $vaultMounts): self
    {
        $self = clone $this;
        $self['vaultMounts'] = $vaultMounts;

        return $self;
    }
}
