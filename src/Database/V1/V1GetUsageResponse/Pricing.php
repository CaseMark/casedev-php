<?php

declare(strict_types=1);

namespace Router\Database\V1\V1GetUsageResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * Current pricing rates.
 *
 * @phpstan-type PricingShape = array{
 *   branchPerMonth?: float|null,
 *   computePerCuHour?: float|null,
 *   freeBranches?: int|null,
 *   storagePerGBMonth?: float|null,
 *   transferPerGB?: float|null,
 * }
 */
final class Pricing implements BaseModel
{
    /** @use SdkModel<PricingShape> */
    use SdkModel;

    /**
     * Cost per branch per month in dollars.
     */
    #[Optional]
    public ?float $branchPerMonth;

    /**
     * Cost per compute unit hour in dollars.
     */
    #[Optional]
    public ?float $computePerCuHour;

    /**
     * Number of free branches included.
     */
    #[Optional]
    public ?int $freeBranches;

    /**
     * Cost per GB of storage per month in dollars.
     */
    #[Optional('storagePerGbMonth')]
    public ?float $storagePerGBMonth;

    /**
     * Cost per GB of data transfer in dollars.
     */
    #[Optional('transferPerGb')]
    public ?float $transferPerGB;

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
        ?float $branchPerMonth = null,
        ?float $computePerCuHour = null,
        ?int $freeBranches = null,
        ?float $storagePerGBMonth = null,
        ?float $transferPerGB = null,
    ): self {
        $self = new self;

        null !== $branchPerMonth && $self['branchPerMonth'] = $branchPerMonth;
        null !== $computePerCuHour && $self['computePerCuHour'] = $computePerCuHour;
        null !== $freeBranches && $self['freeBranches'] = $freeBranches;
        null !== $storagePerGBMonth && $self['storagePerGBMonth'] = $storagePerGBMonth;
        null !== $transferPerGB && $self['transferPerGB'] = $transferPerGB;

        return $self;
    }

    /**
     * Cost per branch per month in dollars.
     */
    public function withBranchPerMonth(float $branchPerMonth): self
    {
        $self = clone $this;
        $self['branchPerMonth'] = $branchPerMonth;

        return $self;
    }

    /**
     * Cost per compute unit hour in dollars.
     */
    public function withComputePerCuHour(float $computePerCuHour): self
    {
        $self = clone $this;
        $self['computePerCuHour'] = $computePerCuHour;

        return $self;
    }

    /**
     * Number of free branches included.
     */
    public function withFreeBranches(int $freeBranches): self
    {
        $self = clone $this;
        $self['freeBranches'] = $freeBranches;

        return $self;
    }

    /**
     * Cost per GB of storage per month in dollars.
     */
    public function withStoragePerGBMonth(float $storagePerGBMonth): self
    {
        $self = clone $this;
        $self['storagePerGBMonth'] = $storagePerGBMonth;

        return $self;
    }

    /**
     * Cost per GB of data transfer in dollars.
     */
    public function withTransferPerGB(float $transferPerGB): self
    {
        $self = clone $this;
        $self['transferPerGB'] = $transferPerGB;

        return $self;
    }
}
