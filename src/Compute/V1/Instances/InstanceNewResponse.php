<?php

declare(strict_types=1);

namespace CaseDev\Compute\V1\Instances;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type InstanceNewResponseShape = array{
 *   id?: string|null,
 *   autoShutdownMinutes?: int|null,
 *   createdAt?: string|null,
 *   gpu?: string|null,
 *   instanceType?: string|null,
 *   message?: string|null,
 *   name?: string|null,
 *   pricePerHour?: string|null,
 *   region?: string|null,
 *   specs?: mixed,
 *   status?: string|null,
 *   vaults?: list<mixed>|null,
 * }
 */
final class InstanceNewResponse implements BaseModel
{
    /** @use SdkModel<InstanceNewResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional(nullable: true)]
    public ?int $autoShutdownMinutes;

    #[Optional]
    public ?string $createdAt;

    #[Optional]
    public ?string $gpu;

    #[Optional]
    public ?string $instanceType;

    #[Optional]
    public ?string $message;

    #[Optional]
    public ?string $name;

    #[Optional]
    public ?string $pricePerHour;

    #[Optional]
    public ?string $region;

    #[Optional]
    public mixed $specs;

    #[Optional]
    public ?string $status;

    /** @var list<mixed>|null $vaults */
    #[Optional(list: 'mixed')]
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
     * @param list<mixed>|null $vaults
     */
    public static function with(
        ?string $id = null,
        ?int $autoShutdownMinutes = null,
        ?string $createdAt = null,
        ?string $gpu = null,
        ?string $instanceType = null,
        ?string $message = null,
        ?string $name = null,
        ?string $pricePerHour = null,
        ?string $region = null,
        mixed $specs = null,
        ?string $status = null,
        ?array $vaults = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $autoShutdownMinutes && $self['autoShutdownMinutes'] = $autoShutdownMinutes;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $gpu && $self['gpu'] = $gpu;
        null !== $instanceType && $self['instanceType'] = $instanceType;
        null !== $message && $self['message'] = $message;
        null !== $name && $self['name'] = $name;
        null !== $pricePerHour && $self['pricePerHour'] = $pricePerHour;
        null !== $region && $self['region'] = $region;
        null !== $specs && $self['specs'] = $specs;
        null !== $status && $self['status'] = $status;
        null !== $vaults && $self['vaults'] = $vaults;

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

    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

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

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * @param list<mixed> $vaults
     */
    public function withVaults(array $vaults): self
    {
        $self = clone $this;
        $self['vaults'] = $vaults;

        return $self;
    }
}
