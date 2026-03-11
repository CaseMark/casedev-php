<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1DraftParams;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1DraftParams\Length\Unit;

/**
 * Target document length.
 *
 * @phpstan-type LengthShape = array{
 *   target?: float|null, unit?: null|Unit|value-of<Unit>
 * }
 */
final class Length implements BaseModel
{
    /** @use SdkModel<LengthShape> */
    use SdkModel;

    /**
     * Target value (e.g., 2000 words or 5 pages).
     */
    #[Optional]
    public ?float $target;

    /**
     * Whether the target length is measured in words or pages.
     *
     * @var value-of<Unit>|null $unit
     */
    #[Optional(enum: Unit::class)]
    public ?string $unit;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Unit|value-of<Unit>|null $unit
     */
    public static function with(
        ?float $target = null,
        Unit|string|null $unit = null
    ): self {
        $self = new self;

        null !== $target && $self['target'] = $target;
        null !== $unit && $self['unit'] = $unit;

        return $self;
    }

    /**
     * Target value (e.g., 2000 words or 5 pages).
     */
    public function withTarget(float $target): self
    {
        $self = clone $this;
        $self['target'] = $target;

        return $self;
    }

    /**
     * Whether the target length is measured in words or pages.
     *
     * @param Unit|value-of<Unit> $unit
     */
    public function withUnit(Unit|string $unit): self
    {
        $self = clone $this;
        $self['unit'] = $unit;

        return $self;
    }
}
