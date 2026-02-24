<?php

declare(strict_types=1);

namespace CaseDev\Compute\V1\Instances\InstanceListResponse;

use CaseDev\Compute\V1\Instances\InstanceListResponse\Instance\Status;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type InstanceShape = array{
 *   id?: string|null,
 *   autoShutdownMinutes?: int|null,
 *   createdAt?: \DateTimeInterface|null,
 *   gpu?: string|null,
 *   instanceType?: string|null,
 *   ip?: string|null,
 *   name?: string|null,
 *   pricePerHour?: string|null,
 *   region?: string|null,
 *   startedAt?: \DateTimeInterface|null,
 *   status?: null|Status|value-of<Status>,
 *   totalCost?: string|null,
 *   totalRuntimeSeconds?: int|null,
 * }
 */
final class Instance implements BaseModel
{
    /** @use SdkModel<InstanceShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional(nullable: true)]
    public ?int $autoShutdownMinutes;

    #[Optional]
    public ?\DateTimeInterface $createdAt;

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

    #[Optional(nullable: true)]
    public ?\DateTimeInterface $startedAt;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    #[Optional]
    public ?string $totalCost;

    #[Optional]
    public ?int $totalRuntimeSeconds;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $id = null,
        ?int $autoShutdownMinutes = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $gpu = null,
        ?string $instanceType = null,
        ?string $ip = null,
        ?string $name = null,
        ?string $pricePerHour = null,
        ?string $region = null,
        ?\DateTimeInterface $startedAt = null,
        Status|string|null $status = null,
        ?string $totalCost = null,
        ?int $totalRuntimeSeconds = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $autoShutdownMinutes && $self['autoShutdownMinutes'] = $autoShutdownMinutes;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $gpu && $self['gpu'] = $gpu;
        null !== $instanceType && $self['instanceType'] = $instanceType;
        null !== $ip && $self['ip'] = $ip;
        null !== $name && $self['name'] = $name;
        null !== $pricePerHour && $self['pricePerHour'] = $pricePerHour;
        null !== $region && $self['region'] = $region;
        null !== $startedAt && $self['startedAt'] = $startedAt;
        null !== $status && $self['status'] = $status;
        null !== $totalCost && $self['totalCost'] = $totalCost;
        null !== $totalRuntimeSeconds && $self['totalRuntimeSeconds'] = $totalRuntimeSeconds;

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

    public function withCreatedAt(\DateTimeInterface $createdAt): self
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

    public function withStartedAt(?\DateTimeInterface $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withTotalCost(string $totalCost): self
    {
        $self = clone $this;
        $self['totalCost'] = $totalCost;

        return $self;
    }

    public function withTotalRuntimeSeconds(int $totalRuntimeSeconds): self
    {
        $self = clone $this;
        $self['totalRuntimeSeconds'] = $totalRuntimeSeconds;

        return $self;
    }
}
