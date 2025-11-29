<?php

declare(strict_types=1);

namespace Casedev\Compute\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Returns detailed compute usage statistics and billing information for your organization. Includes GPU and CPU hours, total runs, costs, and breakdowns by environment. Use optional query parameters to filter by specific year and month.
 *
 * @see Casedev\Services\Compute\V1Service::getUsage()
 *
 * @phpstan-type V1GetUsageParamsShape = array{month?: int, year?: int}
 */
final class V1GetUsageParams implements BaseModel
{
    /** @use SdkModel<V1GetUsageParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Month to filter usage data (1-12, defaults to current month).
     */
    #[Api(optional: true)]
    public ?int $month;

    /**
     * Year to filter usage data (defaults to current year).
     */
    #[Api(optional: true)]
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
        $obj = new self;

        null !== $month && $obj->month = $month;
        null !== $year && $obj->year = $year;

        return $obj;
    }

    /**
     * Month to filter usage data (1-12, defaults to current month).
     */
    public function withMonth(int $month): self
    {
        $obj = clone $this;
        $obj->month = $month;

        return $obj;
    }

    /**
     * Year to filter usage data (defaults to current year).
     */
    public function withYear(int $year): self
    {
        $obj = clone $this;
        $obj->year = $year;

        return $obj;
    }
}
