<?php

declare(strict_types=1);

namespace CaseDev\Voice\Streaming\StreamingGetURLResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type PricingShape = array{
 *   currency?: string|null, perHour?: float|null, perMinute?: float|null
 * }
 */
final class Pricing implements BaseModel
{
    /** @use SdkModel<PricingShape> */
    use SdkModel;

    /**
     * Currency for pricing.
     */
    #[Optional]
    public ?string $currency;

    /**
     * Cost per hour of transcription.
     */
    #[Optional('per_hour')]
    public ?float $perHour;

    /**
     * Cost per minute of transcription.
     */
    #[Optional('per_minute')]
    public ?float $perMinute;

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
        ?string $currency = null,
        ?float $perHour = null,
        ?float $perMinute = null
    ): self {
        $self = new self;

        null !== $currency && $self['currency'] = $currency;
        null !== $perHour && $self['perHour'] = $perHour;
        null !== $perMinute && $self['perMinute'] = $perMinute;

        return $self;
    }

    /**
     * Currency for pricing.
     */
    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Cost per hour of transcription.
     */
    public function withPerHour(float $perHour): self
    {
        $self = clone $this;
        $self['perHour'] = $perHour;

        return $self;
    }

    /**
     * Cost per minute of transcription.
     */
    public function withPerMinute(float $perMinute): self
    {
        $self = clone $this;
        $self['perMinute'] = $perMinute;

        return $self;
    }
}
