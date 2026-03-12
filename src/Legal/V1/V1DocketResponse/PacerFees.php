<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1DocketResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1DocketResponse\PacerFees\Currency;

/**
 * PACER fee information (present when live: true).
 *
 * @phpstan-type PacerFeesShape = array{
 *   currency?: null|Currency|value-of<Currency>,
 *   fetchDurationMs?: int|null,
 *   maxPacerCost?: float|null,
 *   serviceFee?: float|null,
 * }
 */
final class PacerFees implements BaseModel
{
    /** @use SdkModel<PacerFeesShape> */
    use SdkModel;

    /** @var value-of<Currency>|null $currency */
    #[Optional(enum: Currency::class)]
    public ?string $currency;

    /**
     * Time taken for PACER fetch in milliseconds.
     */
    #[Optional]
    public ?int $fetchDurationMs;

    /**
     * Maximum PACER charge per docket in USD.
     */
    #[Optional]
    public ?float $maxPacerCost;

    /**
     * CaseMark service fee in USD.
     */
    #[Optional]
    public ?float $serviceFee;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Currency|value-of<Currency>|null $currency
     */
    public static function with(
        Currency|string|null $currency = null,
        ?int $fetchDurationMs = null,
        ?float $maxPacerCost = null,
        ?float $serviceFee = null,
    ): self {
        $self = new self;

        null !== $currency && $self['currency'] = $currency;
        null !== $fetchDurationMs && $self['fetchDurationMs'] = $fetchDurationMs;
        null !== $maxPacerCost && $self['maxPacerCost'] = $maxPacerCost;
        null !== $serviceFee && $self['serviceFee'] = $serviceFee;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Time taken for PACER fetch in milliseconds.
     */
    public function withFetchDurationMs(int $fetchDurationMs): self
    {
        $self = clone $this;
        $self['fetchDurationMs'] = $fetchDurationMs;

        return $self;
    }

    /**
     * Maximum PACER charge per docket in USD.
     */
    public function withMaxPacerCost(float $maxPacerCost): self
    {
        $self = clone $this;
        $self['maxPacerCost'] = $maxPacerCost;

        return $self;
    }

    /**
     * CaseMark service fee in USD.
     */
    public function withServiceFee(float $serviceFee): self
    {
        $self = clone $this;
        $self['serviceFee'] = $serviceFee;

        return $self;
    }
}
