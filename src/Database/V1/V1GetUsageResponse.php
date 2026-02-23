<?php

declare(strict_types=1);

namespace Router\Database\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Database\V1\V1GetUsageResponse\Period;
use Router\Database\V1\V1GetUsageResponse\Pricing;
use Router\Database\V1\V1GetUsageResponse\Project;
use Router\Database\V1\V1GetUsageResponse\Totals;

/**
 * @phpstan-import-type PeriodShape from \Router\Database\V1\V1GetUsageResponse\Period
 * @phpstan-import-type PricingShape from \Router\Database\V1\V1GetUsageResponse\Pricing
 * @phpstan-import-type ProjectShape from \Router\Database\V1\V1GetUsageResponse\Project
 * @phpstan-import-type TotalsShape from \Router\Database\V1\V1GetUsageResponse\Totals
 *
 * @phpstan-type V1GetUsageResponseShape = array{
 *   period?: null|Period|PeriodShape,
 *   pricing?: null|Pricing|PricingShape,
 *   projectCount?: int|null,
 *   projects?: list<Project|ProjectShape>|null,
 *   totals?: null|Totals|TotalsShape,
 * }
 */
final class V1GetUsageResponse implements BaseModel
{
    /** @use SdkModel<V1GetUsageResponseShape> */
    use SdkModel;

    #[Optional]
    public ?Period $period;

    /**
     * Current pricing rates.
     */
    #[Optional]
    public ?Pricing $pricing;

    /**
     * Total number of projects with usage.
     */
    #[Optional]
    public ?int $projectCount;

    /**
     * Usage breakdown by project.
     *
     * @var list<Project>|null $projects
     */
    #[Optional(list: Project::class)]
    public ?array $projects;

    /**
     * Aggregated totals across all projects.
     */
    #[Optional]
    public ?Totals $totals;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Period|PeriodShape|null $period
     * @param Pricing|PricingShape|null $pricing
     * @param list<Project|ProjectShape>|null $projects
     * @param Totals|TotalsShape|null $totals
     */
    public static function with(
        Period|array|null $period = null,
        Pricing|array|null $pricing = null,
        ?int $projectCount = null,
        ?array $projects = null,
        Totals|array|null $totals = null,
    ): self {
        $self = new self;

        null !== $period && $self['period'] = $period;
        null !== $pricing && $self['pricing'] = $pricing;
        null !== $projectCount && $self['projectCount'] = $projectCount;
        null !== $projects && $self['projects'] = $projects;
        null !== $totals && $self['totals'] = $totals;

        return $self;
    }

    /**
     * @param Period|PeriodShape $period
     */
    public function withPeriod(Period|array $period): self
    {
        $self = clone $this;
        $self['period'] = $period;

        return $self;
    }

    /**
     * Current pricing rates.
     *
     * @param Pricing|PricingShape $pricing
     */
    public function withPricing(Pricing|array $pricing): self
    {
        $self = clone $this;
        $self['pricing'] = $pricing;

        return $self;
    }

    /**
     * Total number of projects with usage.
     */
    public function withProjectCount(int $projectCount): self
    {
        $self = clone $this;
        $self['projectCount'] = $projectCount;

        return $self;
    }

    /**
     * Usage breakdown by project.
     *
     * @param list<Project|ProjectShape> $projects
     */
    public function withProjects(array $projects): self
    {
        $self = clone $this;
        $self['projects'] = $projects;

        return $self;
    }

    /**
     * Aggregated totals across all projects.
     *
     * @param Totals|TotalsShape $totals
     */
    public function withTotals(Totals|array $totals): self
    {
        $self = clone $this;
        $self['totals'] = $totals;

        return $self;
    }
}
