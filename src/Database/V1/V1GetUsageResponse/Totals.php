<?php

declare(strict_types=1);

namespace Router\Database\V1\V1GetUsageResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * Aggregated totals across all projects.
 *
 * @phpstan-type TotalsShape = array{
 *   branchCostDollars?: string|null,
 *   computeCostDollars?: string|null,
 *   computeCuHours?: float|null,
 *   storageCostDollars?: string|null,
 *   storageGBMonths?: float|null,
 *   totalBranches?: int|null,
 *   totalCostDollars?: string|null,
 *   transferCostDollars?: string|null,
 *   transferGB?: float|null,
 * }
 */
final class Totals implements BaseModel
{
    /** @use SdkModel<TotalsShape> */
    use SdkModel;

    /**
     * Total branch cost formatted as dollars.
     */
    #[Optional]
    public ?string $branchCostDollars;

    /**
     * Total compute cost formatted as dollars.
     */
    #[Optional]
    public ?string $computeCostDollars;

    /**
     * Total compute unit hours.
     */
    #[Optional]
    public ?float $computeCuHours;

    /**
     * Total storage cost formatted as dollars.
     */
    #[Optional]
    public ?string $storageCostDollars;

    /**
     * Total storage in GB-months.
     */
    #[Optional('storageGbMonths')]
    public ?float $storageGBMonths;

    /**
     * Total number of branches.
     */
    #[Optional]
    public ?int $totalBranches;

    /**
     * Total cost formatted as dollars.
     */
    #[Optional]
    public ?string $totalCostDollars;

    /**
     * Total transfer cost formatted as dollars.
     */
    #[Optional]
    public ?string $transferCostDollars;

    /**
     * Total data transfer in GB.
     */
    #[Optional('transferGb')]
    public ?float $transferGB;

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
        ?string $branchCostDollars = null,
        ?string $computeCostDollars = null,
        ?float $computeCuHours = null,
        ?string $storageCostDollars = null,
        ?float $storageGBMonths = null,
        ?int $totalBranches = null,
        ?string $totalCostDollars = null,
        ?string $transferCostDollars = null,
        ?float $transferGB = null,
    ): self {
        $self = new self;

        null !== $branchCostDollars && $self['branchCostDollars'] = $branchCostDollars;
        null !== $computeCostDollars && $self['computeCostDollars'] = $computeCostDollars;
        null !== $computeCuHours && $self['computeCuHours'] = $computeCuHours;
        null !== $storageCostDollars && $self['storageCostDollars'] = $storageCostDollars;
        null !== $storageGBMonths && $self['storageGBMonths'] = $storageGBMonths;
        null !== $totalBranches && $self['totalBranches'] = $totalBranches;
        null !== $totalCostDollars && $self['totalCostDollars'] = $totalCostDollars;
        null !== $transferCostDollars && $self['transferCostDollars'] = $transferCostDollars;
        null !== $transferGB && $self['transferGB'] = $transferGB;

        return $self;
    }

    /**
     * Total branch cost formatted as dollars.
     */
    public function withBranchCostDollars(string $branchCostDollars): self
    {
        $self = clone $this;
        $self['branchCostDollars'] = $branchCostDollars;

        return $self;
    }

    /**
     * Total compute cost formatted as dollars.
     */
    public function withComputeCostDollars(string $computeCostDollars): self
    {
        $self = clone $this;
        $self['computeCostDollars'] = $computeCostDollars;

        return $self;
    }

    /**
     * Total compute unit hours.
     */
    public function withComputeCuHours(float $computeCuHours): self
    {
        $self = clone $this;
        $self['computeCuHours'] = $computeCuHours;

        return $self;
    }

    /**
     * Total storage cost formatted as dollars.
     */
    public function withStorageCostDollars(string $storageCostDollars): self
    {
        $self = clone $this;
        $self['storageCostDollars'] = $storageCostDollars;

        return $self;
    }

    /**
     * Total storage in GB-months.
     */
    public function withStorageGBMonths(float $storageGBMonths): self
    {
        $self = clone $this;
        $self['storageGBMonths'] = $storageGBMonths;

        return $self;
    }

    /**
     * Total number of branches.
     */
    public function withTotalBranches(int $totalBranches): self
    {
        $self = clone $this;
        $self['totalBranches'] = $totalBranches;

        return $self;
    }

    /**
     * Total cost formatted as dollars.
     */
    public function withTotalCostDollars(string $totalCostDollars): self
    {
        $self = clone $this;
        $self['totalCostDollars'] = $totalCostDollars;

        return $self;
    }

    /**
     * Total transfer cost formatted as dollars.
     */
    public function withTransferCostDollars(string $transferCostDollars): self
    {
        $self = clone $this;
        $self['transferCostDollars'] = $transferCostDollars;

        return $self;
    }

    /**
     * Total data transfer in GB.
     */
    public function withTransferGB(float $transferGB): self
    {
        $self = clone $this;
        $self['transferGB'] = $transferGB;

        return $self;
    }
}
