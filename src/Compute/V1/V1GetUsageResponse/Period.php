<?php

declare(strict_types=1);

namespace CaseDev\Compute\V1\V1GetUsageResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type PeriodShape = array{
 *   month?: int|null, monthName?: string|null, year?: int|null
 * }
 */
final class Period implements BaseModel
{
    /** @use SdkModel<PeriodShape> */
    use SdkModel;

    #[Optional]
    public ?int $month;

    #[Optional]
    public ?string $monthName;

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
    public static function with(
        ?int $month = null,
        ?string $monthName = null,
        ?int $year = null
    ): self {
        $self = new self;

        null !== $month && $self['month'] = $month;
        null !== $monthName && $self['monthName'] = $monthName;
        null !== $year && $self['year'] = $year;

        return $self;
    }

    public function withMonth(int $month): self
    {
        $self = clone $this;
        $self['month'] = $month;

        return $self;
    }

    public function withMonthName(string $monthName): self
    {
        $self = clone $this;
        $self['monthName'] = $monthName;

        return $self;
    }

    public function withYear(int $year): self
    {
        $self = clone $this;
        $self['year'] = $year;

        return $self;
    }
}
