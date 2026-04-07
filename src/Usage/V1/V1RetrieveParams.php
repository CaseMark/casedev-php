<?php

declare(strict_types=1);

namespace CaseDev\Usage\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Usage\V1\V1RetrieveParams\Granularity;

/**
 * Returns customer-facing usage metrics and costs for the requested period. Supports summary totals and daily buckets for timestamped usage sources. Vault storage is intentionally omitted from totals because it is not yet periodized for arbitrary windows.
 *
 * @see CaseDev\Services\Usage\V1Service::retrieve()
 *
 * @phpstan-type V1RetrieveParamsShape = array{
 *   granularity?: null|Granularity|value-of<Granularity>,
 *   periodEnd?: \DateTimeInterface|null,
 *   periodStart?: \DateTimeInterface|null,
 * }
 */
final class V1RetrieveParams implements BaseModel
{
    /** @use SdkModel<V1RetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Whether to return period totals only or include daily buckets.
     *
     * @var value-of<Granularity>|null $granularity
     */
    #[Optional(enum: Granularity::class)]
    public ?string $granularity;

    /**
     * Period end date. Defaults to now.
     */
    #[Optional]
    public ?\DateTimeInterface $periodEnd;

    /**
     * Period start date. Defaults to the start of the current calendar month.
     */
    #[Optional]
    public ?\DateTimeInterface $periodStart;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Granularity|value-of<Granularity>|null $granularity
     */
    public static function with(
        Granularity|string|null $granularity = null,
        ?\DateTimeInterface $periodEnd = null,
        ?\DateTimeInterface $periodStart = null,
    ): self {
        $self = new self;

        null !== $granularity && $self['granularity'] = $granularity;
        null !== $periodEnd && $self['periodEnd'] = $periodEnd;
        null !== $periodStart && $self['periodStart'] = $periodStart;

        return $self;
    }

    /**
     * Whether to return period totals only or include daily buckets.
     *
     * @param Granularity|value-of<Granularity> $granularity
     */
    public function withGranularity(Granularity|string $granularity): self
    {
        $self = clone $this;
        $self['granularity'] = $granularity;

        return $self;
    }

    /**
     * Period end date. Defaults to now.
     */
    public function withPeriodEnd(\DateTimeInterface $periodEnd): self
    {
        $self = clone $this;
        $self['periodEnd'] = $periodEnd;

        return $self;
    }

    /**
     * Period start date. Defaults to the start of the current calendar month.
     */
    public function withPeriodStart(\DateTimeInterface $periodStart): self
    {
        $self = clone $this;
        $self['periodStart'] = $periodStart;

        return $self;
    }
}
