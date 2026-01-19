<?php

declare(strict_types=1);

namespace Casedev\Compute\V1;

use Casedev\Compute\V1\V1GetUsageResponse\ByEnvironment;
use Casedev\Compute\V1\V1GetUsageResponse\Period;
use Casedev\Compute\V1\V1GetUsageResponse\Summary;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ByEnvironmentShape from \Casedev\Compute\V1\V1GetUsageResponse\ByEnvironment
 * @phpstan-import-type PeriodShape from \Casedev\Compute\V1\V1GetUsageResponse\Period
 * @phpstan-import-type SummaryShape from \Casedev\Compute\V1\V1GetUsageResponse\Summary
 *
 * @phpstan-type V1GetUsageResponseShape = array{
 *   byEnvironment?: list<ByEnvironment|ByEnvironmentShape>|null,
 *   period?: null|Period|PeriodShape,
 *   summary?: null|Summary|SummaryShape,
 * }
 */
final class V1GetUsageResponse implements BaseModel
{
    /** @use SdkModel<V1GetUsageResponseShape> */
    use SdkModel;

    /** @var list<ByEnvironment>|null $byEnvironment */
    #[Optional(list: ByEnvironment::class)]
    public ?array $byEnvironment;

    #[Optional]
    public ?Period $period;

    #[Optional]
    public ?Summary $summary;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<ByEnvironment|ByEnvironmentShape>|null $byEnvironment
     * @param Period|PeriodShape|null $period
     * @param Summary|SummaryShape|null $summary
     */
    public static function with(
        ?array $byEnvironment = null,
        Period|array|null $period = null,
        Summary|array|null $summary = null,
    ): self {
        $self = new self;

        null !== $byEnvironment && $self['byEnvironment'] = $byEnvironment;
        null !== $period && $self['period'] = $period;
        null !== $summary && $self['summary'] = $summary;

        return $self;
    }

    /**
     * @param list<ByEnvironment|ByEnvironmentShape> $byEnvironment
     */
    public function withByEnvironment(array $byEnvironment): self
    {
        $self = clone $this;
        $self['byEnvironment'] = $byEnvironment;

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
     * @param Summary|SummaryShape $summary
     */
    public function withSummary(Summary|array $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }
}
