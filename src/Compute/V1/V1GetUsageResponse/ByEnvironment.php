<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\V1GetUsageResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ByEnvironmentShape = array{
 *   environment?: string|null,
 *   totalCostCents?: int|null,
 *   totalCostFormatted?: string|null,
 *   totalCPUSeconds?: int|null,
 *   totalGPUSeconds?: int|null,
 *   totalRuns?: int|null,
 * }
 */
final class ByEnvironment implements BaseModel
{
    /** @use SdkModel<ByEnvironmentShape> */
    use SdkModel;

    #[Optional]
    public ?string $environment;

    #[Optional]
    public ?int $totalCostCents;

    #[Optional]
    public ?string $totalCostFormatted;

    #[Optional('totalCpuSeconds')]
    public ?int $totalCPUSeconds;

    #[Optional('totalGpuSeconds')]
    public ?int $totalGPUSeconds;

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
        ?string $environment = null,
        ?int $totalCostCents = null,
        ?string $totalCostFormatted = null,
        ?int $totalCPUSeconds = null,
        ?int $totalGPUSeconds = null,
        ?int $totalRuns = null,
    ): self {
        $self = new self;

        null !== $environment && $self['environment'] = $environment;
        null !== $totalCostCents && $self['totalCostCents'] = $totalCostCents;
        null !== $totalCostFormatted && $self['totalCostFormatted'] = $totalCostFormatted;
        null !== $totalCPUSeconds && $self['totalCPUSeconds'] = $totalCPUSeconds;
        null !== $totalGPUSeconds && $self['totalGPUSeconds'] = $totalGPUSeconds;
        null !== $totalRuns && $self['totalRuns'] = $totalRuns;

        return $self;
    }

    public function withEnvironment(string $environment): self
    {
        $self = clone $this;
        $self['environment'] = $environment;

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

    public function withTotalCPUSeconds(int $totalCPUSeconds): self
    {
        $self = clone $this;
        $self['totalCPUSeconds'] = $totalCPUSeconds;

        return $self;
    }

    public function withTotalGPUSeconds(int $totalGPUSeconds): self
    {
        $self = clone $this;
        $self['totalGPUSeconds'] = $totalGPUSeconds;

        return $self;
    }

    public function withTotalRuns(int $totalRuns): self
    {
        $self = clone $this;
        $self['totalRuns'] = $totalRuns;

        return $self;
    }
}
