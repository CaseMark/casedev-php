<?php

declare(strict_types=1);

namespace Casedev\Database\V1\V1GetUsageResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type PeriodShape = array{
 *   end?: \DateTimeInterface|null, start?: \DateTimeInterface|null
 * }
 */
final class Period implements BaseModel
{
    /** @use SdkModel<PeriodShape> */
    use SdkModel;

    /**
     * End of the billing period.
     */
    #[Optional]
    public ?\DateTimeInterface $end;

    /**
     * Start of the billing period.
     */
    #[Optional]
    public ?\DateTimeInterface $start;

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
        ?\DateTimeInterface $end = null,
        ?\DateTimeInterface $start = null
    ): self {
        $self = new self;

        null !== $end && $self['end'] = $end;
        null !== $start && $self['start'] = $start;

        return $self;
    }

    /**
     * End of the billing period.
     */
    public function withEnd(\DateTimeInterface $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * Start of the billing period.
     */
    public function withStart(\DateTimeInterface $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
