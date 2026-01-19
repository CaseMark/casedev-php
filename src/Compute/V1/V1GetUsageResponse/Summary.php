<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\V1GetUsageResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SummaryShape = array{
 *   totalCostCents?: int|null,
 *   totalCostFormatted?: string|null,
 *   totalCPUHours?: float|null,
 *   totalGPUHours?: float|null,
 *   totalRuns?: int|null,
 * }
 */
final class Summary implements BaseModel
{
    /** @use SdkModel<SummaryShape> */
    use SdkModel;

    #[Optional]
    public ?int $totalCostCents;

    #[Optional]
    public ?string $totalCostFormatted;

    #[Optional('totalCpuHours')]
    public ?float $totalCPUHours;

    #[Optional('totalGpuHours')]
    public ?float $totalGPUHours;

    #[Optional]
    public ?int $totalRuns;

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
        ?int $totalCostCents = null,
        ?string $totalCostFormatted = null,
        ?float $totalCPUHours = null,
        ?float $totalGPUHours = null,
        ?int $totalRuns = null,
    ): self {
        $self = new self;

        null !== $totalCostCents && $self['totalCostCents'] = $totalCostCents;
        null !== $totalCostFormatted && $self['totalCostFormatted'] = $totalCostFormatted;
        null !== $totalCPUHours && $self['totalCPUHours'] = $totalCPUHours;
        null !== $totalGPUHours && $self['totalGPUHours'] = $totalGPUHours;
        null !== $totalRuns && $self['totalRuns'] = $totalRuns;

        return $self;
    }

    public function withTotalCostCents(int $totalCostCents): self
    {
        $self = clone $this;
        $self['totalCostCents'] = $totalCostCents;

        return $self;
    }

    public function withTotalCostFormatted(string $totalCostFormatted): self
    {
        $self = clone $this;
        $self['totalCostFormatted'] = $totalCostFormatted;

        return $self;
    }

    public function withTotalCPUHours(float $totalCPUHours): self
    {
        $self = clone $this;
        $self['totalCPUHours'] = $totalCPUHours;

        return $self;
    }

    public function withTotalGPUHours(float $totalGPUHours): self
    {
        $self = clone $this;
        $self['totalGPUHours'] = $totalGPUHours;

        return $self;
    }

    public function withTotalRuns(int $totalRuns): self
    {
        $self = clone $this;
        $self['totalRuns'] = $totalRuns;

        return $self;
    }
}
