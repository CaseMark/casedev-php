<?php

declare(strict_types=1);

namespace CaseDev\Compute\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Returns detailed compute usage statistics and billing information for your organization. Includes GPU and CPU hours, total runs, costs, and breakdowns by environment. Use optional query parameters to filter by specific year and month.
 *
 * @see CaseDev\Services\Compute\V1Service::getUsage()
 *
 * @phpstan-type V1GetUsageParamsShape = array{month?: int|null, year?: int|null}
 */
final class V1GetUsageParams implements BaseModel
{
    /** @use SdkModel<V1GetUsageParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Month to filter usage data (1-12, defaults to current month).
     */
    #[Optional]
    public ?int $month;

    /**
     * Year to filter usage data (defaults to current year).
     */
    #[Optional]
    public ?int $year;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $month = null, ?int $year = null): self
    {
        $self = new self;

        null !== $month && $self['month'] = $month;
        null !== $year && $self['year'] = $year;

        return $self;
    }

    /**
     * Month to filter usage data (1-12, defaults to current month).
     */
    public function withMonth(int $month): self
    {
        $self = clone $this;
        $self['month'] = $month;

        return $self;
    }

    /**
     * Year to filter usage data (defaults to current year).
     */
    public function withYear(int $year): self
    {
        $self = clone $this;
        $self['year'] = $year;

        return $self;
    }
}
